<?php

namespace App\Services;

use App\Models\PlanilhaReaquecimentoAlimento;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaReaquecimentoAlimentoService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaReaquecimentoAlimento::create($data);

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

            $planilha = DB::table('planilha_reaquecimento_alimentos')
                        ->where('id', $data['id'])
                        ->update([
                            'data' => $data['data'],
                            'id_parameter_produto' => $data['id_parameter_produto'],
                            'hora_temperatura_antes' => $data['hora_temperatura_antes'],
                            'temperatura_antes' => $data['temperatura_antes'],
                            'hora_temperatura_depois' => $data['hora_temperatura_depois'],
                            'temperatura_depois' => $data['temperatura_depois'],
                            'tempo_aquecimento' => $data['tempo_aquecimento'],
                            'conforme_naoconforme' => $data['conforme_naoconforme'],
                            'id_parameter_responsavel' => $data['id_parameter_responsavel'],
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

            $planilha = DB::table('planilha_reaquecimento_alimentos')
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
                                                p_re.name as responsavel,
                                                pra.*
                                            FROM
                                                planilha_reaquecimento_alimentos pra
                                                JOIN parameters p_pr ON pra.id_parameter_produto = p_pr.id
                                                JOIN parameters p_re ON pra.id_parameter_responsavel = p_re.id
                                                JOIN users us ON pra.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                pra.status = 'A'
                                            ORDER BY
                                                pra.id DESC"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_reaquecimento_alimentos pra WHERE pra.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
