<?php

namespace App\Services;

use App\Models\PlanilhaOcorrenciaPraga;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaOcorrenciaPragaService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaOcorrenciaPraga::create($data);

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

            $planilha = DB::table('planilha_ocorrencia_pragas')
                        ->where('id', $data['id'])
                        ->update([
                            'data' => $data['data'],
                            'id_parameter_area' => $data['id_parameter_area'],
                            'id_parameter_praga' => $data['id_parameter_praga'],
                            'observacoes' => $data['observacoes']
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

            $planilha = DB::table('planilha_ocorrencia_pragas')
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
            if (!empty($filter_array['id_parameter_area_filter'])) {
                $filter .= " and main_tb.id_parameter_area = {$filter_array['id_parameter_area_filter']}";
            }
            if (!empty($filter_array['id_parameter_praga_filter'])) {
                $filter .= " and main_tb.id_parameter_praga = {$filter_array['id_parameter_praga_filter']}";
            }

            $return = DB::select( DB::raw("SELECT
                                                us.name as usuario,
                                                ifnull(un.name, 'Controle') as unidade,
                                                p_ar.name as area,
                                                p_pr.name as praga,
                                                main_tb.*
                                            FROM
                                                planilha_ocorrencia_pragas main_tb
                                                JOIN parameters p_ar ON main_tb.id_parameter_area = p_ar.id
                                                JOIN parameters p_pr ON main_tb.id_parameter_praga = p_pr.id
                                                JOIN users us ON main_tb.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                main_tb.status = 'A' {$filter}
                                            ORDER BY
                                                main_tb.data"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_ocorrencia_pragas main_tb WHERE main_tb.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
