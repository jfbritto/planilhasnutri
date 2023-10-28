<?php

namespace App\Services;

use App\Models\PlanilhaTemperaturaAlimentoDistribuicao;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaTemperaturaAlimentoDistribuicaoService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaTemperaturaAlimentoDistribuicao::create($data);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function update(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $planilha = DB::table('planilha_temperatura_alimento_distribuicaos')
                        ->where('id', $data['id'])
                        ->update([
                            'data' => $data['data'],
                            'periodo' => $data['periodo'],
                            'id_parameter_evento' => $data['id_parameter_evento'],
                            'id_parameter_responsavel' => $data['id_parameter_responsavel'],
                            'acao_corretiva' => $data['acao_corretiva']
                        ]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $planilha];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function destroy(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $planilha = DB::table('planilha_temperatura_alimento_distribuicaos')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $planilha];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function list($filter_array)
    {
        $response = [];

        try{

            $condition = "";
            if (auth()->user()->id_unit) {
                $condition = " and us.id_unit = ".auth()->user()->id_unit;
            }

            $filter = "";
            if (!empty($filter_array['data_ini_filter']) && !empty($filter_array['data_fim_filter'])) {
                $filter .= " and main_tb.data between '{$filter_array['data_ini_filter']}' and '{$filter_array['data_fim_filter']}'";
            }
            if (!empty($filter_array['id_parameter_evento_filter'])) {
                $filter .= " and main_tb.id_parameter_evento = {$filter_array['id_parameter_evento_filter']}";
            }
            if (!empty($filter_array['periodo_filter'])) {
                $filter .= " and main_tb.periodo = '{$filter_array['periodo_filter']}'";
            }

            $return = DB::select( DB::raw("SELECT
                                                us.name as usuario,
                                                ifnull(un.name, 'Controle') as unidade,
                                                ifnull(p_ev.name, '-') as evento,
                                                p_re.name as responsavel,
                                                count(ptadp.id) as total_produtos,
                                                main_tb.*
                                            FROM
                                                planilha_temperatura_alimento_distribuicaos main_tb
                                                LEFT JOIN parameters p_ev ON main_tb.id_parameter_evento = p_ev.id
                                                LEFT JOIN planilha_temperatura_alimento_distribuicao_produtos ptadp ON main_tb.id = ptadp.id_planilha_distribuicao
                                                JOIN parameters p_re ON main_tb.id_parameter_responsavel = p_re.id
                                                JOIN users us ON main_tb.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                main_tb.status = 'A' {$filter}
                                            GROUP BY
	                                            main_tb.id
                                            ORDER BY
                                                main_tb.id DESC"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function find($filter_array)
    {
        $response = [];

        try{

            $condition = "";
            if (auth()->user()->id_unit) {
                $condition = " and us.id_unit = ".auth()->user()->id_unit;
            }

            $filter = "";
            if (!empty($filter_array['id_planilha_filter'])) {
                $filter .= " and main_tb.id = '{$filter_array['id_planilha_filter']}'";
            }
            $return = DB::select( DB::raw("SELECT
                                                us.name as usuario,
                                                ifnull(un.name, 'Controle') as unidade,
                                                ifnull(p_ev.name, '-') as evento,
                                                p_pr.name as produto,
                                                p_re.name as responsavel,
                                                ptadp.hora_1,
                                                ptadp.temperatura_1,
                                                ptadp.hora_2,
                                                ptadp.temperatura_2,
                                                main_tb.*
                                            FROM
                                                planilha_temperatura_alimento_distribuicaos main_tb
                                                JOIN parameters p_re ON main_tb.id_parameter_responsavel = p_re.id
                                                LEFT JOIN parameters p_ev ON main_tb.id_parameter_evento = p_ev.id
                                                LEFT JOIN planilha_temperatura_alimento_distribuicao_produtos ptadp ON main_tb.id = ptadp.id_planilha_distribuicao
                                                LEFT JOIN parameters p_pr ON ptadp.id_parameter_produto = p_pr.id
                                                JOIN users us ON main_tb.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                main_tb.status = 'A' {$filter}
                                            ORDER BY
                                                main_tb.id DESC"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
