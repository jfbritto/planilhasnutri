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

            $condition = "";
            if(auth()->user()->is_nutri) {
                $condition = "AND ws.id_user = ".auth()->user()->id;
            }

            $return = DB::select( DB::raw("SELECT
                                                wt.name AS name,
                                                un.name AS unit_name,
                                                us.name AS user_name,
                                                ws.*
                                            FROM
                                                worksheets ws
                                                JOIN worksheet_structures wt ON ws.id_worksheet_structure = wt.id
                                                JOIN units un ON ws.id_unit = un.id
                                                JOIN users us ON ws.id_user = us.id
                                            WHERE
                                                ws.status = 'A' {$condition}
                                            ORDER BY
                                                ws.id_worksheet_structure"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
