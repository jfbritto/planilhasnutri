<?php

namespace App\Services;

use App\Models\WorksheetStructure;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class WorksheetStructureService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = WorksheetStructure::create($data);

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

            $worksheetStructures = DB::table('worksheet_structures')
                        ->where('id', $data['id'])
                        ->update(['name' => $data['name'],
                                'description' => $data['description']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $worksheetStructures];

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

            $worksheetStructures = DB::table('worksheet_structures')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $worksheetStructures];

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
            $return = DB::select( DB::raw("select * from worksheet_structures where status = 'A' order by name"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
