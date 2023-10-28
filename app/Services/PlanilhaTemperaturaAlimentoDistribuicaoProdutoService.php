<?php

namespace App\Services;

use App\Models\PlanilhaTemperaturaAlimentoDistribuicaoProduto;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaTemperaturaAlimentoDistribuicaoProdutoService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaTemperaturaAlimentoDistribuicaoProduto::create($data);

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

            $planilha = DB::table('planilha_temperatura_alimento_distribuicao_produtos')
                        ->where('id', $data['id'])
                        ->update([
                            'id_parameter_produto' => $data['id_parameter_produto'],
                            'hora_1' => $data['hora_1'],
                            'temperatura_1' => $data['temperatura_1'],
                            'hora_2' => $data['hora_2'],
                            'temperatura_2' => $data['temperatura_2'],
                            'hora_3' => $data['hora_3'],
                            'temperatura_3' => $data['temperatura_3'],
                            'hora_4' => $data['hora_4'],
                            'temperatura_4' => $data['temperatura_4'],
                            'hora_5' => $data['hora_5'],
                            'temperatura_5' => $data['temperatura_5'],
                            'hora_6' => $data['hora_6'],
                            'temperatura_6' => $data['temperatura_6'],
                            'hora_7' => $data['hora_7'],
                            'temperatura_7' => $data['temperatura_7']
                        ]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $planilha];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function destroy($id)
    {
        $response = [];

        try{

            DB::beginTransaction();

            DB::table('planilha_temperatura_alimento_distribuicao_produtos')
                        ->where('id_planilha_distribuicao', $id)
                        ->delete();

            DB::commit();

            $response = ['status' => 'success'];

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
            if (!empty($filter_array['id_planilha_distribuicao_filter'])) {
                $filter .= " and main_tb.id_planilha_distribuicao = {$filter_array['id_planilha_distribuicao_filter']}";
            }

            $return = DB::select( DB::raw("SELECT
                                                us.name as usuario,
                                                ifnull(un.name, 'Controle') as unidade,
                                                p_pr.name as produto,
                                                main_tb.*
                                            FROM
                                                planilha_temperatura_alimento_distribuicao_produtos main_tb
                                                JOIN parameters p_pr ON main_tb.id_parameter_produto = p_pr.id
                                                JOIN users us ON main_tb.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                main_tb.status = 'A' {$filter}
                                            ORDER BY
                                                main_tb.id"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_temperatura_alimento_distribuicao_produtos main_tb WHERE main_tb.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
