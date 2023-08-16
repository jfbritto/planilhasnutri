<?php

namespace App\Services;

use App\Models\PlanilhaRegistroCongelamento;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaRegistroCongelamentoService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaRegistroCongelamento::create($data);

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

            $planilha = DB::table('planilha_registro_congelamentos')
                        ->where('id', $data['id'])
                        ->update([
                            'data_congelamento' => $data['data_congelamento'],
                            'id_parameter_produto' => $data['id_parameter_produto'],
                            'quantidade' => $data['quantidade'],
                            'data_recebimento' => $data['data_recebimento'],
                            'data_fabricacao' => $data['data_fabricacao'],
                            'alergeno' => $data['alergeno'],
                        ]);

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

            $planilha = DB::table('planilha_registro_congelamentos')
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
                                                p_pd.name as produto,
                                                prc.*
                                            FROM
                                                planilha_registro_congelamentos prc
                                                JOIN parameters p_pd ON prc.id_parameter_produto = p_pd.id
                                                JOIN users us ON prc.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                prc.status = 'A'
                                            ORDER BY
                                                prc.data_congelamento DESC"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_registro_congelamentos prc WHERE prc.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}