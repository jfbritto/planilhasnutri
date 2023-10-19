<?php

namespace App\Services;

use App\Models\PlanilhaLimpezaCaixaGordura;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaLimpezaCaixaGorduraService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaLimpezaCaixaGordura::create($data);

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

            $planilha = DB::table('planilha_limpeza_caixa_gorduras')
                        ->where('id', $data['id'])
                        ->update([
                            'id_parameter_caixa_gordura' => $data['id_parameter_caixa_gordura'],
                            'id_parameter_area' => $data['id_parameter_area'],
                            'id_parameter_responsavel' => $data['id_parameter_responsavel'],
                            'data_limpeza' => $data['data_limpeza'],
                            'data_proxima_limpeza' => $data['data_proxima_limpeza'],
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

            $planilha = DB::table('planilha_limpeza_caixa_gorduras')
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
                                                p_cg.name as caixa_gordura,
                                                p_ar.name as area,
                                                p_re.name as responsavel,
                                                main_tb.*
                                            FROM
                                                planilha_limpeza_caixa_gorduras main_tb
                                                JOIN parameters p_cg ON main_tb.id_parameter_caixa_gordura = p_cg.id
                                                JOIN parameters p_ar ON main_tb.id_parameter_area = p_ar.id
                                                JOIN parameters p_re ON main_tb.id_parameter_responsavel = p_re.id
                                                JOIN users us ON main_tb.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                main_tb.status = 'A' {$filter}
                                            ORDER BY
                                                main_tb.data_limpeza DESC"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_limpeza_caixa_gorduras main_tb WHERE main_tb.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
