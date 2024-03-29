<?php

namespace App\Services;

use App\Models\PlanilhaTemperaturaEquipamentoAreaClimatizada;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaTemperaturaEquipamentoAreaClimatizadaService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaTemperaturaEquipamentoAreaClimatizada::create($data);

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

            $planilha = PlanilhaTemperaturaEquipamentoAreaClimatizada::find($data['id']);
            $planilha->fill($data)->save();

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

            $planilha = DB::table('planilha_temperatura_equipamento_area_climatizadas')
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
            if (!empty($filter_array['data_ini_filter'])) {
                $filter .= " and main_tb.data >= '{$filter_array['data_ini_filter']}'";
            }
            if (!empty($filter_array['data_fim_filter'])) {
                $filter .= " and main_tb.data <= '{$filter_array['data_fim_filter']}'";
            }
            if (!empty($filter_array['id_parameter_equipamento_filter'])) {
                $filter .= " and main_tb.id_parameter_equipamento = {$filter_array['id_parameter_equipamento_filter']}";
            }

            $return = DB::select( DB::raw("SELECT
                                                us.name as usuario,
                                                ifnull(un.name, 'Controle') as unidade,
                                                p_eq.name as equipamento,
                                                p_re.name as responsavel,
                                                conf_eq.maior_que,
                                                conf_eq.menor_que,
                                                main_tb.*
                                            FROM
                                                planilha_temperatura_equipamento_area_climatizadas main_tb
                                                JOIN parameters p_eq ON main_tb.id_parameter_equipamento = p_eq.id
                                                JOIN parameters p_re ON main_tb.id_parameter_responsavel = p_re.id
                                                LEFT JOIN planilha_temperatura_equipamento_area_climatizada_configs conf_eq ON main_tb.id_parameter_equipamento = conf_eq.id_parameter_equipamento and conf_eq.status = 'A'
                                                JOIN users us ON main_tb.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                main_tb.status = 'A' {$filter}
                                            ORDER BY
                                                main_tb.data DESC, main_tb.id_parameter_equipamento"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_temperatura_equipamento_area_climatizadas main_tb WHERE main_tb.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
