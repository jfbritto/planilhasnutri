<?php

namespace App\Services;

use App\Models\PlanilhaRecebimentoMateriaPrima;
use Exception;
use Illuminate\Support\Facades\DB as DB;

class PlanilhaRecebimentoMateriaPrimaService
{
    public function store(array $data)
    {
        $response = [];

        try{
            DB::beginTransaction();

            $result = PlanilhaRecebimentoMateriaPrima::create($data);

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

            $planilha = DB::table('planilha_recebimento_materia_primas')
                        ->where('id', $data['id'])
                        ->update([
                            'data' => $data['data'],
                            'id_parameter_produto' => $data['id_parameter_produto'],
                            'id_parameter_fornecedor' => $data['id_parameter_fornecedor'],
                            'ordem_de_compra' => $data['ordem_de_compra'],
                            'nota_fiscal' => $data['nota_fiscal'],
                            'sif_lote' => $data['sif_lote'],
                            'data_validade' => $data['data_validade'],
                            'temperatura_alimento' => $data['temperatura_alimento'],
                            'temperatura_veiculo' => $data['temperatura_veiculo'],
                            'nao_conformidade' => $data['nao_conformidade'],
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

            $planilha = DB::table('planilha_recebimento_materia_primas')
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
                                                p_pd.name as produto,
                                                p_fo.name as fornecedor,
                                                p_re.name as responsavel,
                                                prmp.*
                                            FROM
                                                planilha_recebimento_materia_primas prmp
                                                JOIN parameters p_pd ON prmp.id_parameter_produto = p_pd.id
                                                JOIN parameters p_fo ON prmp.id_parameter_fornecedor = p_fo.id
                                                JOIN parameters p_re ON prmp.id_parameter_responsavel = p_re.id
                                                JOIN users us ON prmp.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                            WHERE
                                                prmp.status = 'A'
                                            ORDER BY
                                                prmp.id DESC"));

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
            $return = DB::select( DB::raw("SELECT * FROM planilha_recebimento_materia_primas prmp WHERE prmp.status = 'A' AND id = {$id}"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
