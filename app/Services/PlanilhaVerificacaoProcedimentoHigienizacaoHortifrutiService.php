<?php

namespace App\Services;

use App\Models\PlanilhaVerificacaoProcedimentoHigienizacaoHortifruti;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaVerificacaoProcedimentoHigienizacaoHortifruti::create($data);

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

            $planilha = DB::table('planilha_verificacao_procedimento_higienizacao_hortifrutis')
                        ->where('id', $data['id'])
                        ->update([
                            'data' => $data['data'],
                            'id_parameter_alimento' => $data['id_parameter_alimento'],
                            'hora_imersao_inicio' => $data['hora_imersao_inicio'],
                            'hora_imersao_fim' => $data['hora_imersao_fim'],
                            'concentracao_solucao_clorada' => $data['concentracao_solucao_clorada'],
                            'acao_corretiva' => $data['acao_corretiva'],
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

            $planilha = DB::table('planilha_verificacao_procedimento_higienizacao_hortifrutis')
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
                                                p_al.name as alimento,
                                                p_re.name as responsavel,
                                                pvphh.*
                                            FROM
                                                planilha_verificacao_procedimento_higienizacao_hortifrutis pvphh
                                                JOIN parameters p_al ON pvphh.id_parameter_alimento = p_al.id
                                                JOIN parameters p_re ON pvphh.id_parameter_responsavel = p_re.id
                                                JOIN users us ON pvphh.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                pvphh.status = 'A'
                                            ORDER BY
                                                pvphh.data DESC"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_verificacao_procedimento_higienizacao_hortifrutis pvphh WHERE pvphh.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}