<?php

namespace App\Services;

use App\Models\PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacao;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacao::create($data);

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

            $planilha = DB::table('planilha_registro_nao_conformidade_detectada_auto_avaliacaos')
                        ->where('id', $data['id'])
                        ->update([
                            'data' => $data['data'],
                            'nao_conformidade' => $data['nao_conformidade'],
                            'possiveis_causas' => $data['possiveis_causas'],
                            'tratamento_produto' => $data['tratamento_produto'],
                            'acoes_corretivas' => $data['acoes_corretivas'],
                            'id_parameter_responsavel' => $data['id_parameter_responsavel']
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

            $planilha = DB::table('planilha_registro_nao_conformidade_detectada_auto_avaliacaos')
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
                                                p_re.name as responsavel,
                                                prncdaa.*
                                            FROM
                                                planilha_registro_nao_conformidade_detectada_auto_avaliacaos prncdaa
                                                JOIN parameters p_re ON prncdaa.id_parameter_responsavel = p_re.id
                                                JOIN users us ON prncdaa.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                prncdaa.status = 'A'
                                            ORDER BY
                                                prncdaa.id DESC"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_registro_nao_conformidade_detectada_auto_avaliacaos prncdaa WHERE prncdaa.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
