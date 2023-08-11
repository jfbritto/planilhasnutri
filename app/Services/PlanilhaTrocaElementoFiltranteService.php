<?php

namespace App\Services;

use App\Models\PlanilhaTrocaElementoFiltrante;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaTrocaElementoFiltranteService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaTrocaElementoFiltrante::create($data);

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

            $planilha = DB::table('planilha_troca_elemento_filtrantes')
                        ->where('id', $data['id'])
                        ->update(['name' => $data['name']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $planilha];

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

            $planilha = DB::table('planilha_troca_elemento_filtrantes')
                        ->where('id', $data['id'])
                        ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $planilha];

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
            if (auth()->user()->id_unit) {
                $condition = " and us.id_unit = ".auth()->user()->id_unit;
            }

            $return = DB::select( DB::raw("SELECT
                                                us.name as usuario,
                                                ifnull(un.name, 'Controle') as unidade,
                                                p_ar.name as area,
                                                p_fi.name as filtro,
                                                p_re.name as responsavel,
                                                ptef.*
                                            FROM
                                                planilha_troca_elemento_filtrantes ptef
                                                JOIN parameters p_ar ON ptef.id_parameter_area = p_ar.id
                                                JOIN parameters p_fi ON ptef.id_parameter_filtro = p_fi.id
                                                JOIN parameters p_re ON ptef.id_parameter_responsavel = p_re.id
                                                JOIN users us ON ptef.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                ptef.status = 'A'
                                            ORDER BY
                                                ptef.data_troca DESC"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_troca_elemento_filtrantes ptef WHERE ptef.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
