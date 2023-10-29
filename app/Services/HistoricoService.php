<?php

namespace App\Services;

use App\Models\Historico;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class HistoricoService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = Historico::create($data);

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
                $condition = " and us.id_unit = ".auth()->user()->id_unit;
            }

            $filter = "";
            if (!empty($filter_array['id_planilha_filter'])) {
                $filter .= " and main_tb.id_planilha = {$filter_array['id_planilha_filter']}";
            }
            if (!empty($filter_array['id_planilha_registro_filter'])) {
                $filter .= " and main_tb.id_planilha_registro = {$filter_array['id_planilha_registro_filter']}";
            }

            $return = DB::select( DB::raw("SELECT
                                                ifnull(un.name, 'Todas') as unit_name,
                                                us.name as usuario,
                                                pl.name as planilha,
                                                main_tb.data,
                                                main_tb.acao
                                            FROM
                                                historicos main_tb
                                                JOIN users us ON main_tb.id_user = us.id
                                                LEFT JOIN planilhas pl ON main_tb.id_planilha = pl.id
                                                LEFT JOIN units un ON main_tb.id_unit = un.id
                                            WHERE
                                                main_tb.status = 'A' {$condition} {$filter}
                                            ORDER BY
                                                main_tb.id"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
