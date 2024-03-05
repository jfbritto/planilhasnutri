<?php

namespace App\Services;

use App\Models\Parameter;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class ParameterService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = Parameter::create($data);

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

            self::validaPermissao($data['id']);

            DB::beginTransaction();

            $parameters = DB::table('parameters')
                        ->where('id', $data['id'])
                        ->update(['name' => $data['name']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $parameters];

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

            self::validaPermissao($data['id']);

            DB::beginTransaction();

            $parameters = DB::table('parameters')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $parameters];

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
                $condition = " and (pm.id_unit = ".auth()->user()->id_unit." or pm.id_unit is null)";
            }

            $filter = "";
            if (!empty($filter_array['id_parameter_type'])) {
                $filter .= " AND pm.id_parameter_type = {$filter_array['id_parameter_type']} ";
            }
            if (!empty($filter_array['name'])) {
                $filter .= " AND pm.name like '{$filter_array['name']}'";
            }

            $return = DB::select( DB::raw("SELECT
                                                ifnull(un.name, 'Todas') as unit_name,
                                                pm.*
                                            FROM
                                                parameters pm
                                                LEFT JOIN units un ON pm.id_unit = un.id
                                            WHERE
                                                pm.status = 'A' {$condition} {$filter}
                                            ORDER BY
                                                pm.name"));

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

            $condition = "";
            if (auth()->user()->id_unit) {
                $condition = " and (pm.id_unit = ".auth()->user()->id_unit." or pm.id_unit is null)";
            }

            // apenas para o golden tulip porto vitoria
            $order = "pm.name";
            if (auth()->user()->id_unit == 8) {
                $order = "pm.id";
            }

            $return = DB::select( DB::raw("SELECT
                                                ifnull(un.name, 'Todas') as unit_name,
                                                pm.*
                                            FROM
                                                parameters pm
                                                LEFT JOIN units un ON pm.id_unit = un.id
                                            WHERE
                                                pm.status = 'A' AND id_parameter_type = {$id} {$condition}
                                            ORDER BY
                                                {$order}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    /**
     * valida se usuário pode executar a ação
     * @param int $id
     */
    private function validaPermissao(int $id)
    {
        $result = Parameter::find($id);
        if (
            $result
            && empty($result->id_unit)
            && !empty(auth()->user()->id_unit)
        ) {
            throw new Exception('Você não tem permissão para executar esta ação!');
        }
    }
}
