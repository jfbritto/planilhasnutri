<?php

namespace App\Services;

use App\Models\Unit;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class UnitService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = Unit::create($data);

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

            $units = DB::table('units')
                        ->where('id', $data['id'])
                        ->update(['name' => $data['name'],
                                'city' => $data['city'],
                                'neighborhood' => $data['neighborhood'],
                                'description' => $data['description']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $units];

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

            $units = DB::table('units')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $units];

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
            $return = DB::select( DB::raw("select * from units where status = 'A' order by name"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
