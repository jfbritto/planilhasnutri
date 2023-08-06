<?php

namespace App\Services;

use App\Models\Worksheet;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class WorksheetService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = Worksheet::create($data);

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

            $worksheets = DB::table('worksheets')
                        ->where('id', $data['id'])
                        ->update(['description' => $data['description']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $worksheets];

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

            $worksheets = DB::table('worksheets')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $worksheets];

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
            $return = DB::select( DB::raw("select wt.name as name, un.name as unit_name, us.name as user_name, ws.* from worksheets ws
                                            join worksheet_structures wt on ws.id_worksheet_structure = wt.id
                                            join units un on ws.id_unit = un.id
                                            join users us on ws.id_user = us.id
                                            where ws.status = 'A' order by ws.id_worksheet_structure"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
