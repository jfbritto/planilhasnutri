<?php

namespace App\Services;

use App\Models\Document;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Storage;

class DocumentService
{
    /**
     * Salva um novo documento no banco de dados.
     *
     * @param array $data Os dados do documento a serem salvos.
     * @return array Um array contendo o status da operação e os dados do documento salvo.
     */
    public function store(array $data)
    {
        try {
            DB::beginTransaction();

            $document = Document::create($data);

            DB::commit();

            return ['status' => 'success', 'data' => $document];
        } catch (QueryException $e) {
            DB::rollBack();
            return ['status' => 'error', 'data' => 'Erro ao salvar no banco de dados'];
        } catch (Exception $e) {
            DB::rollBack();
            return ['status' => 'error', 'data' => $e->getMessage()];
        }
    }

    /**
     * Deleta um documento do banco de dados pelo ID.
     *
     * @param int $id O ID do documento a ser deletado.
     * @return \Illuminate\Http\JsonResponse Uma resposta JSON indicando o status da operação.
     */
    public function destroy(int $id)
    {
        try {
            // Encontre o documento pelo ID
            $documento = Document::findOrFail($id);

            $nomeDoc = $documento->file;

            // Deleta o documento
            $documento->delete();

            self::deletarArquivo($nomeDoc);

            // Retorna uma resposta de sucesso
            return response()->json(['mensagem' => 'Documento deletado com sucesso']);
        } catch (ModelNotFoundException $ex) {
            // Se o Documento não for encontrado, retorna uma resposta de erro
            return response()->json(['mensagem' => 'Documento não encontrado'], 404);
        } catch (\Exception $ex) {
            // Em caso de outras exceções, retorna uma resposta de erro genérica
            return response()->json(['mensagem' => 'Ocorreu um erro ao deletar o documento'], 500);
        }
    }

    /**
     * Busca documentos no banco de dados com base em critérios específicos.
     *
     * @param string $planilha_base O valor de "planilha_base" a ser buscado.
     * @param int $id_unit O ID da unidade a ser buscada.
     * @param int $id O ID do documento a ser buscado.
     * @return array Um array contendo o status da operação e os dados dos documentos encontrados.
     */
    public function find($planilha_base, $id_unit, $id)
    {
        $response = [];

        try {
            $documentos = Document::where('planilha_base', $planilha_base)
                ->where('id_unit', $id_unit)
                ->where('id_planilha', $id)
                ->get();

            $response = ['status' => 'success', 'data' => $documentos];
        } catch (\Exception $e) {
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    /**
     * Busca documentos no banco de dados com base em critérios específicos.
     *
     * @param string $planilha_base O valor de "planilha_base" a ser buscado.
     * @param int $id_unit O ID da unidade a ser buscada.
     * @param int $id O ID do documento a ser buscado.
     * @return array Um array contendo o status da operação e os dados dos documentos encontrados.
     */
    public function findUnique($id)
    {
        $response = [];

        try {
            $documentos = Document::where('id', $id)->get();

            $response = ['status' => 'success', 'data' => $documentos];
        } catch (\Exception $e) {
            $response = ['status' => 'error', 'data' => $e->getMessage()];
        }

        return $response;
    }

    /**
     *
     *
     * FUNÇÕES DE MANIPULAÇÃO DE ARQUIVOS
     *
     *
     */

    public function uploadDocumento($documento, $planilha_base, $id_planilha)
    {
        $nomeOriginal = pathinfo($documento->getClientOriginalName(), PATHINFO_FILENAME); // Obtém o nome do arquivo sem a extensão
        $extensao = $documento->getClientOriginalExtension(); // Obtém a extensão do arquivo
        $idUnidade = auth()->user()->id_unit;

        // Remove caracteres especiais do nome do arquivo
        $nomeFormatado = preg_replace('/[^A-Za-z0-9]/', '', $nomeOriginal);

        // Concatena o nome formatado com a extensão do arquivo
        $fileName = md5(mt_rand(1000, 9999).time().$nomeFormatado). '.' . $extensao;

        // Verifica se a pasta 'servicos' existe. Se não, cria a pasta.
        if (!Storage::exists("public/documentos/{$idUnidade}")) {
            Storage::makeDirectory("public/documentos/{$idUnidade}");
        }

        $documento->storeAs("public/documentos/{$idUnidade}", $fileName);

        $data = [
            'id_user' => auth()->user()->id,
            'id_unit' => auth()->user()->id_unit,
            'planilha_base' => $planilha_base,
            'id_planilha' => $id_planilha,
            'file' => $fileName
        ];

        self::store($data);

        return $fileName;
    }

    public function downloadArquivo($fileName)
    {
        $idUnidade = auth()->user()->id_unit;

        $caminhoArquivo = storage_path("app/public/documentos/{$idUnidade}/" . $fileName);

        // Verifica se o arquivo existe
        if (!Storage::exists("public/documentos/{$idUnidade}/" . $fileName)) {
            abort(404); // Se o arquivo não existir, retorna um erro 404
        }

        // Obtém o tipo de conteúdo (MIME type) do arquivo
        $mimeType = Storage::mimeType("public/documentos/{$idUnidade}/" . $fileName);

        // Define os cabeçalhos da resposta
        $headers = [
            "Content-Type" => $mimeType,
        ];

        // Retorna uma resposta de download
        return [$caminhoArquivo, $fileName, $headers];
    }

    public function deletarArquivo($fileName)
    {
        $idUnidade = auth()->user()->id_unit;

        // Verifica se o arquivo existe
        if (Storage::exists("public/documentos/{$idUnidade}/" . $fileName)) {
            // Deleta o arquivo
            Storage::delete("public/documentos/{$idUnidade}/" . $fileName);
            return "Arquivo $fileName deletado com sucesso!";
        } else {
            return "Arquivo $fileName não encontrado!";
        }
    }

    /**
     * Lista os documentos
     *
     */
    public function list($planilha_base, $id)
    {
        try {
            // Condição para filtrar por unidade do usuário, se houver
            $condition = auth()->user()->id_unit ? "AND main_tb.id_unit = " . auth()->user()->id_unit : "";

            // Consulta SQL para obter os dados filtrados
            $result = DB::select(DB::raw("SELECT
                                                main_tb.*
                                            FROM
                                                documents main_tb
                                                JOIN users us ON main_tb.id_user = us.id {$condition}
                                            WHERE
                                                main_tb.planilha_base = {$planilha_base} AND main_tb.id_planilha = {$id}
                                            ORDER BY
                                                main_tb.id DESC"));

            return ['status' => 'success', 'data' => $result];
        } catch (Exception $e) {
            return ['status' => 'error', 'data' => $e->getMessage()];
        }
    }
}
