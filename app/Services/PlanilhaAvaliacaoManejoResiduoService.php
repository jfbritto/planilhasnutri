<?php

namespace App\Services;

use App\Models\PlanilhaAvaliacaoManejoResiduo;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaAvaliacaoManejoResiduoService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaAvaliacaoManejoResiduo::create($data);

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

            $planilha = DB::table('planilha_avaliacao_manejo_residuos')
                        ->where('id', $data['id'])
                        ->update([
                            'data' => $data['data'],
                            'lixeira_apropriada' => $data['lixeira_apropriada'],
                            'retirada_conforme' => $data['retirada_conforme'],
                            'manipuladores_treinados' => $data['manipuladores_treinados'],
                            'area_externa_apropriada' => $data['area_externa_apropriada'],
                            'residuos_organicos_retirados' => $data['residuos_organicos_retirados'],
                            'area_externa_higienizada' => $data['area_externa_higienizada'],
                            'observacoes' => $data['observacoes'],
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

            $planilha = DB::table('planilha_avaliacao_manejo_residuos')
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

    public function list($filter_array)
    {
        $response = [];

        try{

            $condition = "";
            if (auth()->user()->id_unit) {
                $condition = " and us.id_unit = ".auth()->user()->id_unit;
            }

            $filter = "";
            if (!empty($filter_array['data_ini']) && !empty($filter_array['data_fim'])) {
                $data_ini = date('Y-m-01', strtotime($filter_array['data_ini']));
                $data_fim = date('Y-m-t', strtotime($filter_array['data_fim']));
                $filter .= " and main_tb.data between '{$data_ini}' and '{$data_fim}'";
            }

            $return = DB::select( DB::raw("SELECT
                                                us.name as usuario,
                                                ifnull(un.name, 'Controle') as unidade,
                                                main_tb.*
                                            FROM
                                                planilha_avaliacao_manejo_residuos main_tb
                                                JOIN users us ON main_tb.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                main_tb.status = 'A' {$filter}
                                            ORDER BY
                                                main_tb.id DESC"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_avaliacao_manejo_residuos main_tb WHERE main_tb.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
