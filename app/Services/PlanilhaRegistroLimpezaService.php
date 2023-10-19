<?php

namespace App\Services;

use App\Models\PlanilhaRegistroLimpeza;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaRegistroLimpezaService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaRegistroLimpeza::create($data);

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

            $planilha = DB::table('planilha_registro_limpezas')
                        ->where('id', $data['id'])
                        ->update([
                            'data' => $data['data'],
                            'id_parameter_responsavel' => $data['id_parameter_responsavel'],
                            'id_parameter_area' => $data['id_parameter_area'],
                            'superficie_limpa' => $data['superficie_limpa'],
                            'frequencia' => $data['frequencia'],
                            'conforme_naoconforme' => $data['conforme_naoconforme'],
                            'comentarios' => $data['comentarios'],
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

            $planilha = DB::table('planilha_registro_limpezas')
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
            if (!empty($filter_array['id_parameter_area'])) {
                $filter .= " and main_tb.id_parameter_area = {$filter_array['id_parameter_area']}";
            }

            $return = DB::select( DB::raw("SELECT
                                                us.name as usuario,
                                                ifnull(un.name, 'Controle') as unidade,
                                                p_ar.name as area,
                                                p_re.name as responsavel,
                                                main_tb.*
                                            FROM
                                                planilha_registro_limpezas main_tb
                                                JOIN parameters p_ar ON main_tb.id_parameter_area = p_ar.id
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
            $return = DB::select( DB::raw("SELECT * FROM planilha_registro_limpezas main_tb WHERE main_tb.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
