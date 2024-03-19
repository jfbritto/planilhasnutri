<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = User::create($data);

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

            $result = User::find($data['id']);
            $result->fill($data)->save();

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function updatePassword(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = DB::table('users')
                        ->where('id', $data['id'])
                        ->update(['password' => $data['password']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

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

            $result = DB::table('users')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

        }catch(Exception $e){
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    public function changeStatus(array $data)
    {
        $response = [];

        try{

            DB::beginTransaction();

            $result = DB::table('users')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $result];

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
                $condition = " and id_unit = ".auth()->user()->id_unit;
            }

            $filter = "";
            if (!empty($filter_array['status_filter'])) {
                $filter .= "usr.status = '{$filter_array['status_filter']}'";
            } else {
                $filter .= "usr.status IN ('A','I')";
            }

            $return = DB::select( DB::raw("
                SELECT
                    ifnull(un.name, 'Controle') as unidade,
                    usr.*
                FROM
                    users usr
                    left join units un on un.id=usr.id_unit
                WHERE
                    {$filter} {$condition}
                ORDER BY
                    usr.id_unit, usr.name, usr.status"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }


}
