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

    public function list()
    {
        $response = [];

        try{

            $return = DB::select( DB::raw("SELECT
                                                ifnull(un.name, 'Todas') as unit_name,
                                                pm.*
                                            FROM
                                                parameters pm
                                                LEFT JOIN units un ON pm.id_unit = un.id
                                            WHERE
                                                pm.status = 'A'
                                            ORDER BY
                                                pm.name"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
