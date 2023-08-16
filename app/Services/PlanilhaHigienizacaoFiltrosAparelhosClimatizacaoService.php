<?php

namespace App\Services;

use App\Models\PlanilhaHigienizacaoFiltrosAparelhosClimatizacao;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaHigienizacaoFiltrosAparelhosClimatizacao::create($data);

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

            $planilha = DB::table('planilha_higienizacao_filtros_aparelhos_climatizacaos')
                        ->where('id', $data['id'])
                        ->update([
                            'id_parameter_area' => $data['id_parameter_area'],
                            'id_parameter_equipamento' => $data['id_parameter_equipamento'],
                            'id_parameter_responsavel' => $data['id_parameter_responsavel'],
                            'data_higienizacao' => $data['data_higienizacao'],
                            'data_proxima_higienizacao' => $data['data_proxima_higienizacao'],
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

            $planilha = DB::table('planilha_higienizacao_filtros_aparelhos_climatizacaos')
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
                                                phfac.*
                                            FROM
                                                planilha_higienizacao_filtros_aparelhos_climatizacaos phfac
                                                JOIN parameters p_ar ON phfac.id_parameter_area = p_ar.id
                                                JOIN parameters p_eq ON phfac.id_parameter_equipamento = p_eq.id
                                                JOIN parameters p_re ON phfac.id_parameter_responsavel = p_re.id
                                                JOIN users us ON phfac.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                phfac.status = 'A'
                                            ORDER BY
                                                phfac.data_higienizacao DESC"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_higienizacao_filtros_aparelhos_climatizacaos phfac WHERE phfac.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}