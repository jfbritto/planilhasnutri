<?php

namespace App\Services;

use App\Models\PlanilhaLimpezaCaixaGordura;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaLimpezaCaixaGorduraService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaLimpezaCaixaGordura::create($data);

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

            $planilha = DB::table('planilha_limpeza_caixa_gorduras')
                        ->where('id', $data['id'])
                        ->update([
                            'id_parameter_caixa_gordura' => $data['id_parameter_caixa_gordura'],
                            'id_parameter_local' => $data['id_parameter_local'],
                            'id_parameter_responsavel' => $data['id_parameter_responsavel'],
                            'data_limpeza' => $data['data_limpeza'],
                            'data_proxima_limpeza' => $data['data_proxima_limpeza'],
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

            $planilha = DB::table('planilha_limpeza_caixa_gorduras')
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
                                                p_cg.name as caixa_gordura,
                                                p_lo.name as nome_local,
                                                p_re.name as responsavel,
                                                plcg.*
                                            FROM
                                                planilha_limpeza_caixa_gorduras plcg
                                                JOIN parameters p_cg ON plcg.id_parameter_caixa_gordura = p_cg.id
                                                JOIN parameters p_lo ON plcg.id_parameter_local = p_lo.id
                                                JOIN parameters p_re ON plcg.id_parameter_responsavel = p_re.id
                                                JOIN users us ON plcg.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                plcg.status = 'A'
                                            ORDER BY
                                                plcg.data_limpeza DESC"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_limpeza_caixa_gorduras plcg WHERE plcg.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
