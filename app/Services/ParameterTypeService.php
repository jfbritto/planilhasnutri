<?php

namespace App\Services;

use App\Models\ParameterType;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class ParameterTypeService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = ParameterType::create($data);

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

            $parameterType = DB::table('parameter_types')
                        ->where('id', $data['id'])
                        ->update(['name' => $data['name']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $parameterType];

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

            $parameterType = DB::table('parameter_types')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $parameterType];

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
            $return = DB::select( DB::raw("select ifnull(un.name, 'Todas') as unidade, pt.* from parameter_types pt left join units un on un.id=pt.id_unit where pt.status = 'A' order by pt.name"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
