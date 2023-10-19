<?php

namespace App\Services;

use App\Models\PlanilhaResfriamentoRapidoAlimento;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaResfriamentoRapidoAlimentoService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaResfriamentoRapidoAlimento::create($data);

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

            $planilha = DB::table('planilha_resfriamento_rapido_alimentos')
                        ->where('id', $data['id'])
                        ->update([
                            'data' => $data['data'],
                            'id_parameter_produto' => $data['id_parameter_produto'],
                            'cozimento_hora_final' => $data['cozimento_hora_final'],
                            'cozimento_temperatura_interna' => $data['cozimento_temperatura_interna'],
                            'resfriamento_hora_inicio' => $data['resfriamento_hora_inicio'],
                            'resfriamento_temperatura_central_inicio' => $data['resfriamento_temperatura_central_inicio'],
                            'resfriamento_hora_fim' => $data['resfriamento_hora_fim'],
                            'resfriamento_temperatura_central_fim' => $data['resfriamento_temperatura_central_fim'],
                            'conforme_naoconforme' => $data['conforme_naoconforme'],
                            'id_parameter_responsavel' => $data['id_parameter_responsavel'],
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

            $planilha = DB::table('planilha_resfriamento_rapido_alimentos')
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
            if (!empty($filter_array['id_parameter_produto'])) {
                $filter .= " and main_tb.id_parameter_produto = {$filter_array['id_parameter_produto']}";
            }

            $return = DB::select( DB::raw("SELECT
                                                us.name as usuario,
                                                ifnull(un.name, 'Controle') as unidade,
                                                p_pr.name as produto,
                                                p_re.name as responsavel,
                                                main_tb.*
                                            FROM
                                                planilha_resfriamento_rapido_alimentos main_tb
                                                JOIN parameters p_pr ON main_tb.id_parameter_produto = p_pr.id
                                                JOIN parameters p_re ON main_tb.id_parameter_responsavel = p_re.id
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

    public function find($id)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("SELECT * FROM planilha_resfriamento_rapido_alimentos main_tb WHERE main_tb.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
