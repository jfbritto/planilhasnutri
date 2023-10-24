<?php

namespace App\Services;

use App\Models\PlanilhaTemperaturaAlimentoBanhoMaria;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaTemperaturaAlimentoBanhoMariaService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaTemperaturaAlimentoBanhoMaria::create($data);

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

            $planilha = DB::table('planilha_temperatura_alimento_banho_marias')
                        ->where('id', $data['id'])
                        ->update([
                            'data' => $data['data'],
                            'periodo' => $data['periodo'],
                            'id_parameter_produto' => $data['id_parameter_produto'],
                            'primeira_hora' => $data['primeira_hora'],
                            'primeira_tremperatura' => $data['primeira_tremperatura'],
                            'segunda_hora' => $data['segunda_hora'],
                            'segunda_tremperatura' => $data['segunda_tremperatura'],
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

            $planilha = DB::table('planilha_temperatura_alimento_banho_marias')
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
            if (!empty($filter_array['id_parameter_produto_filter'])) {
                $filter .= " and main_tb.id_parameter_produto = {$filter_array['id_parameter_produto_filter']}";
            }

            $return = DB::select( DB::raw("SELECT
                                                us.name as usuario,
                                                ifnull(un.name, 'Controle') as unidade,
                                                p_pr.name as produto,
                                                main_tb.*
                                            FROM
                                                planilha_temperatura_alimento_banho_marias main_tb
                                                JOIN parameters p_pr ON main_tb.id_parameter_produto = p_pr.id
                                                JOIN users us ON main_tb.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                main_tb.status = 'A' {$filter}
                                            ORDER BY
                                                main_tb.data, main_tb.periodo"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_temperatura_alimento_banho_marias main_tb WHERE main_tb.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
