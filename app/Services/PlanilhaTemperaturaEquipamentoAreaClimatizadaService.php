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

            $planilha = DB::table('planilha_temperatura_equipamento_area_climatizadas')
                        ->where('id', $data['id'])
                        ->update([
                            'data' => $data['data'],
                            'id_parameter_responsavel' => $data['id_parameter_responsavel'],
                            'id_parameter_equipamento' => $data['id_parameter_equipamento'],
                            'temperatura_1' => $data['temperatura_1'],
                            'temperatura_2' => $data['temperatura_2']
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

    public function list()
    {
        $response = [];

        try{

            $condition = "";
            if (auth()->user()->id_unit) {
                $condition = " and us.id_unit = ".auth()->user()->id_unit;
            }

            $return = DB::select( DB::raw("SELECT
                                                us.name as usuario,
                                                ifnull(un.name, 'Controle') as unidade,
                                                p_eq.name as equipamento,
                                                p_re.name as responsavel,
                                                pteac.*
                                            FROM
                                                planilha_temperatura_equipamento_area_climatizadas pteac
                                                JOIN parameters p_eq ON pteac.id_parameter_equipamento = p_eq.id
                                                JOIN parameters p_re ON pteac.id_parameter_responsavel = p_re.id
                                                JOIN users us ON pteac.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                pteac.status = 'A'
                                            ORDER BY
                                                pteac.id DESC"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_temperatura_equipamento_area_climatizadas pteac WHERE pteac.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
