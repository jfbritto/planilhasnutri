<?php

namespace App\Services;

use App\Models\PlanilhaRastreabilidadeDiaria;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaRastreabilidadeDiariaService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaRastreabilidadeDiaria::create($data);

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

            $planilha = PlanilhaRastreabilidadeDiaria::find($data['id']);

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

            $planilha = DB::table('planilha_rastreabilidade_diarias')
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

            $condition = auth()->user()->id_unit ? "AND us.id_unit = " . auth()->user()->id_unit : "";

            $filter = "";
            if (!empty($filter_array['data_ini_filter'])) {
                $filter .= " and main_tb.data >= '{$filter_array['data_ini_filter']}'";
            }
            if (!empty($filter_array['data_fim_filter'])) {
                $filter .= " and main_tb.data <= '{$filter_array['data_fim_filter']}'";
            }
            if (!empty($filter_array['id_parameter_produto_filter'])) {
                $filter .= " and main_tb.id_parameter_produto = {$filter_array['id_parameter_produto_filter']}";
            }


            $return = DB::select( DB::raw("SELECT
                                                us.name as usuario,
                                                ifnull(un.name, 'Controle') as unidade,
                                                p_pr.name as produto,
                                                p_fa.name as fabricante,
                                                GROUP_CONCAT(doc.file SEPARATOR ', ') AS files,
                                                main_tb.*
                                            FROM
                                                planilha_rastreabilidade_diarias main_tb
                                                JOIN parameters p_pr ON main_tb.id_parameter_produto = p_pr.id
                                                JOIN parameters p_fa ON main_tb.id_parameter_fabricante = p_fa.id
                                                JOIN users us ON main_tb.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                                LEFT JOIN documents doc ON main_tb.id = doc.id_planilha AND doc.planilha_base = 19
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

    public function find($id)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("SELECT
                                                main_tb.*,
                                                GROUP_CONCAT(doc.file SEPARATOR ', ') AS files
                                            FROM
                                                planilha_rastreabilidade_diarias main_tb
                                                LEFT JOIN documents doc ON main_tb.id = doc.id_planilha AND doc.planilha_base = 19
                                            WHERE
                                                main_tb.status = 'A' AND main_tb.id = {$id}
                                            GROUP BY
                                                main_tb.id"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
