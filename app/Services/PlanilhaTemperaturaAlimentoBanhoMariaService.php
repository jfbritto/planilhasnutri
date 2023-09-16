<?php

namespace App\Services;

use App\Models\PlanilhaTemperaturaAlimentoBanhoMaria;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaTemperaturaAlimentoBanhoMariaService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaTemperaturaAlimentoBanhoMaria::create($data);

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

            $planilha = DB::table('planilha_temperatura_alimento_banho_marias')
                        ->where('id', $data['id'])
                        ->update([
                            'data' => $data['data'],
                            'periodo' => $data['periodo'],
                            'id_parameter_produto' => $data['id_parameter_produto'],
                            'primeira_hora' => $data['primeira_hora'],
                            'primeira_tremperatura' => $data['primeira_tremperatura'],
                            'segunda_hora' => $data['segunda_hora'],
                            'segunda_tremperatura' => $data['segunda_tremperatura'],
                            'acao_corretiva' => $data['acao_corretiva']
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

            $planilha = DB::table('planilha_temperatura_alimento_banho_marias')
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
                                                p_pr.name as produto,
                                                ptabm.*
                                            FROM
                                                planilha_temperatura_alimento_banho_marias ptabm
                                                JOIN parameters p_pr ON ptabm.id_parameter_produto = p_pr.id
                                                JOIN users us ON ptabm.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                ptabm.status = 'A'
                                            ORDER BY
                                                ptabm.id DESC"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_temperatura_alimento_banho_marias ptabm WHERE ptabm.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
