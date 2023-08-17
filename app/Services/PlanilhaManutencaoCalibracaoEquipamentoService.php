<?php

namespace App\Services;

use App\Models\PlanilhaManutencaoCalibracaoEquipamento;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaManutencaoCalibracaoEquipamentoService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaManutencaoCalibracaoEquipamento::create($data);

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

            $planilha = DB::table('planilha_manutencao_calibracao_equipamentos')
                        ->where('id', $data['id'])
                        ->update([
                            'id_parameter_equipamento' => $data['id_parameter_equipamento'],
                            'calibracao_foi_feita' => $data['calibracao_foi_feita'],
                            'data_calibracao' => $data['data_calibracao'],
                            'equipamento_com_problema' => $data['equipamento_com_problema'],
                            'qual_problema' => $data['qual_problema'],
                            'providencias_tomadas' => $data['providencias_tomadas'],
                            'problema_foi_solucionado' => $data['problema_foi_solucionado'],
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

            $planilha = DB::table('planilha_manutencao_calibracao_equipamentos')
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
                                                p_eq.name as equipamento,
                                                pmce.*
                                            FROM
                                                planilha_manutencao_calibracao_equipamentos pmce
                                                JOIN parameters p_eq ON pmce.id_parameter_equipamento = p_eq.id
                                                JOIN users us ON pmce.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                pmce.status = 'A'
                                            ORDER BY
                                                pmce.id DESC"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_manutencao_calibracao_equipamentos pmce WHERE pmce.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
