<?php

namespace App\Services;

use App\Models\PlanilhaSaturacaoOleoGordura;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaSaturacaoOleoGorduraService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaSaturacaoOleoGordura::create($data);

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

            $planilha = DB::table('planilha_saturacao_oleo_gorduras')
                        ->where('id', $data['id'])
                        ->update([
                            'data' => $data['data'],
                            'id_parameter_area' => $data['id_parameter_area'],
                            'id_parameter_equipamento' => $data['id_parameter_equipamento'],
                            'hora_primeira_afericao' => $data['hora_primeira_afericao'],
                            'temperatura_primeira_afericao' => $data['temperatura_primeira_afericao'],
                            'hora_segunda_afericao' => $data['hora_segunda_afericao'],
                            'temperatura_segunda_afericao' => $data['temperatura_segunda_afericao'],
                            'acao_corretiva' => $data['acao_corretiva'],
                            'id_parameter_responsavel_acao' => $data['id_parameter_responsavel_acao'],
                            'leitura_fita' => $data['leitura_fita'],
                            'id_parameter_situacao_gordura' => $data['id_parameter_situacao_gordura'],
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

            $planilha = DB::table('planilha_saturacao_oleo_gorduras')
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
                                                p_eq.name as equipamento,
                                                p_re.name as responsavel,
                                                psog.*
                                            FROM
                                                planilha_saturacao_oleo_gorduras psog
                                                JOIN parameters p_ar ON psog.id_parameter_area = p_ar.id
                                                JOIN parameters p_eq ON psog.id_parameter_equipamento = p_eq.id
                                                JOIN parameters p_re ON psog.id_parameter_responsavel = p_re.id
                                                JOIN users us ON psog.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                psog.status = 'A'
                                            ORDER BY
                                                psog.data DESC"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_saturacao_oleo_gorduras psog WHERE psog.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
