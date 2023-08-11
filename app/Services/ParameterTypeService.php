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

            self::validaPermissao($data['id']);

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

            self::validaPermissao($data['id']);

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
            $return = DB::select( DB::raw("SELECT
                                                IFNULL(un.name, 'Todas') as unidade, pt.*
                                            FROM
                                                parameter_types pt
                                                LEFT JOIN units un on un.id = pt.id_unit
                                            WHERE
                                                pt.status = 'A'
                                            ORDER BY
                                                pt.name"));

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
        $result = ParameterType::find($id);
        if (
            $result
            && empty($result->id_unit)
            && !empty(auth()->user()->id_unit)
        ) {
            throw new Exception('Você não tem permissão para executar esta ação!');
        }
    }
}
