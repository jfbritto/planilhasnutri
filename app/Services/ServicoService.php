<?php

namespace App\Services;

use App\Models\Servico;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB as DB;

class ServicoService
{
    /**
     * Cria um novo serviço no banco de dados.
     *
     * @param array $data Os dados do serviço a serem salvos.
     * @return array Um array contendo o status da operação e os dados do serviço criado.
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();

            $servico = Servico::create($data);

            DB::commit();

            return ['status' => 'success', 'data' => $servico];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'data' => 'Erro ao salvar no banco de dados'];
        } catch (Exception $e) {
            DB::rollBack();
            return ['status' => 'error', 'data' => $e->getMessage()];
        }
    }

    /**
     * Atualiza um serviço no banco de dados.
     *
     * @param array $data Os dados do serviço a serem atualizados.
     * @return array Um array contendo o status da operação e os dados do serviço atualizado.
     */
    public function update(array $data)
    {
        $response = [];

        try {
            DB::beginTransaction();

            $servico = Servico::find($data['id']);

            if (!$servico) {
                throw new \Exception('Serviço não encontrado');
            }

            $servico->fill($data)->save();

            DB::commit();

            $response = ['status' => 'success', 'data' => $servico];
        } catch (QueryException $e) {
            DB::rollBack();
            $response = ['status' => 'error', 'data' => 'Erro ao atualizar o serviço no banco de dados'];
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    /**
     * Atualiza o status de um serviço no banco de dados.
     *
     * @param array $data Os dados contendo o ID do serviço e o novo status.
     * @return array Um array contendo o status da operação e o número de linhas afetadas.
     */
    public function destroy(array $data)
    {
        $response = [];

        try {
            DB::beginTransaction();

            // Atualiza o status do serviço no banco de dados
            $affectedRows = DB::table('servicos')
                ->where('id', $data['id'])
                ->update(['status' => $data['status']]);

            DB::commit();

            $response = ['status' => 'success', 'data' => $affectedRows];
        } catch (Exception $e) {
            DB::rollBack();
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    /**
     * Lista os serviços com base em filtros.
     *
     * @param array $filterArray Um array contendo os filtros a serem aplicados.
     * @return array Um array contendo o status da operação e os dados dos serviços filtrados.
     */
    public function list(array $filterArray)
    {
        try {
            // Condição para filtrar por unidade do usuário, se houver
            $condition = auth()->user()->id_unit ? "AND us.id_unit = " . auth()->user()->id_unit : "";

            // Construção da cláusula WHERE com base nos filtros fornecidos
            $filter = "main_tb.status IN ('A','C')"; // Filtro padrão para status
            if (!empty($filterArray['status_filter'])) {
                $filter = "main_tb.status = '{$filterArray['status_filter']}'";
            }
            if (!empty($filterArray['data_ini_filter'])) {
                $filter .= " AND main_tb.data >= '{$filterArray['data_ini_filter']}'";
            }
            if (!empty($filterArray['data_fim_filter'])) {
                $filter .= " AND main_tb.data <= '{$filterArray['data_fim_filter']}'";
            }
            if (!empty($filterArray['id_parameter_servico_filter'])) {
                $filter .= " AND main_tb.id_parameter_servico = {$filterArray['id_parameter_servico_filter']}";
            }

            // echo $filter;
            // exit;

            // Consulta SQL para obter os dados filtrados
            $result = DB::select(DB::raw("SELECT
                                                us.name as usuario,
                                                IFNULL(un.name, 'Controle') as unidade,
                                                p_se.name as servico,
                                                GROUP_CONCAT(doc.file SEPARATOR ', ') AS files,
                                                main_tb.*
                                            FROM
                                                servicos main_tb
                                                JOIN parameters p_se ON main_tb.id_parameter_servico = p_se.id
                                                JOIN users us ON main_tb.id_user = us.id {$condition}
                                                LEFT JOIN units un ON us.id_unit = un.id
                                                LEFT JOIN documents doc ON main_tb.id = doc.id_planilha AND doc.planilha_base = 20
                                            WHERE
                                                {$filter}
                                            GROUP BY
                                                main_tb.id
                                            ORDER BY
                                                main_tb.id DESC"));

            return ['status' => 'success', 'data' => $result];
        } catch (Exception $e) {
            return ['status' => 'error', 'data' => $e->getMessage()];
        }
    }

    public function find($id)
    {
        $response = [];

        try{
            $return = DB::select( DB::raw("SELECT
                                                main_tb.*,
                                                GROUP_CONCAT(doc.file SEPARATOR ', ') AS files
                                            FROM
                                                servicos main_tb
                                                LEFT JOIN documents doc ON main_tb.id = doc.id_planilha AND doc.planilha_base = 20
                                            WHERE
                                                main_tb.status = 'A' AND main_tb.id = {$id}
                                            GROUP BY
                                                main_tb.id"));

            $response = ['status' => 'success', 'data' => $return];
        }catch(Exception $e){
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }
}
