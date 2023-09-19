<?php

namespace App\Services;

use App\Models\PlanilhaTemperaturaAlimentoDistribuicao;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaTemperaturaAlimentoDistribuicaoService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaTemperaturaAlimentoDistribuicao::create($data);

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

            $planilha = DB::table('planilha_temperatura_alimento_distribuicaos')
                        ->where('id', $data['id'])
                        ->update([
                            'data' => $data['data'],
                            'periodo' => $data['periodo'],
                            'id_parameter_produto' => $data['id_parameter_produto'],
                            'id_parameter_evento' => $data['id_parameter_evento'],
                            'id_parameter_responsavel' => $data['id_parameter_responsavel'],
                            'hora_1' => $data['hora_1'],
                            'tremperatura_1' => $data['tremperatura_1'],
                            'hora_2' => $data['hora_2'],
                            'tremperatura_2' => $data['tremperatura_2'],
                            'hora_3' => $data['hora_3'],
                            'tremperatura_3' => $data['tremperatura_3'],
                            'hora_4' => $data['hora_4'],
                            'tremperatura_4' => $data['tremperatura_4'],
                            'hora_5' => $data['hora_5'],
                            'tremperatura_5' => $data['tremperatura_5'],
                            'hora_6' => $data['hora_6'],
                            'tremperatura_6' => $data['tremperatura_6'],
                            'hora_7' => $data['hora_7'],
                            'tremperatura_7' => $data['tremperatura_7'],
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

            $planilha = DB::table('planilha_temperatura_alimento_distribuicaos')
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
                                                p_ev.name as evento,
                                                p_re.name as responsavel,
                                                p_pr.name as produto,
                                                ptad.*
                                            FROM
                                                planilha_temperatura_alimento_distribuicaos ptad
                                                JOIN parameters p_ev ON ptad.id_parameter_evento = p_ev.id
                                                JOIN parameters p_re ON ptad.id_parameter_responsavel = p_re.id
                                                JOIN parameters p_pr ON ptad.id_parameter_produto = p_pr.id
                                                JOIN users us ON ptad.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                ptad.status = 'A'
                                            ORDER BY
                                                ptad.id DESC"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_temperatura_alimento_distribuicaos ptad WHERE ptad.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
