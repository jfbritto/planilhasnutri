<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ServicoService;
use Illuminate\Support\Facades\Storage;

class ServicoController extends Controller
{
    private $servicoService;

    public function __construct(ServicoService $servicoService)
    {
        $this->servicoService = $servicoService;
    }

    public function index()
    {
        return view('servico.home');
    }

    public function store(Request $request)
    {

        $documento = $request->file('documento');

        $fileName = '';
        if (!empty($documento)) {
            $fileName = $this->uploadDocumento($documento);
        }

        $data = [
            'id_user' => auth()->user()->id,
            'id_parameter_servico' => $request->id_parameter_servico,
            'data' => $request->data,
            'proxima_data' => $request->proxima_data,
            'frequencia_meses' => $request->frequencia_meses,
            'documento' => $fileName,
            'observacoes' => $request->observacoes
        ];

        $response = $this->servicoService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function uploadDocumento($documento)
    {
        $nomeOriginal = pathinfo($documento->getClientOriginalName(), PATHINFO_FILENAME); // Obtém o nome do arquivo sem a extensão
        $extensao = $documento->getClientOriginalExtension(); // Obtém a extensão do arquivo
        $idUnidade = auth()->user()->id_unit;
        $anoAtual = date('Y');

        // Remove caracteres especiais do nome do arquivo
        $nomeFormatado = preg_replace('/[^A-Za-z0-9]/', '', $nomeOriginal);

        // Concatena o nome formatado com a extensão do arquivo
        $fileName = md5(time().$nomeFormatado). '.' . $extensao;

        // Verifica se a pasta 'servicos' existe. Se não, cria a pasta.
        if (!Storage::exists("arquivos/servicos/{$idUnidade}/{$anoAtual}")) {
            Storage::makeDirectory("arquivos/servicos/{$idUnidade}/{$anoAtual}");
        }

        $documento->storeAs("arquivos/servicos/{$idUnidade}/{$anoAtual}", $fileName);
        return $fileName;
    }

    public function downloadArquivo($fileName)
    {
        $idUnidade = auth()->user()->id_unit;
        $anoAtual = date('Y');

        $caminhoArquivo = storage_path("app/arquivos/servicos/{$idUnidade}/{$anoAtual}/" . $fileName);

        // Verifica se o arquivo existe
        if (!Storage::exists("arquivos/servicos/{$idUnidade}/{$anoAtual}/" . $fileName)) {
            abort(404); // Se o arquivo não existir, retorna um erro 404
        }

        // Obtém o tipo de conteúdo (MIME type) do arquivo
        $mimeType = Storage::mimeType("arquivos/servicos/{$idUnidade}/{$anoAtual}/" . $fileName);

        // Define os cabeçalhos da resposta
        $headers = [
            "Content-Type" => $mimeType,
        ];

        // Retorna uma resposta de download
        return response()->download($caminhoArquivo, $fileName, $headers);
    }

    public function deletarArquivo($fileName)
    {
        $idUnidade = auth()->user()->id_unit;
        $anoAtual = date('Y');

        // Verifica se o arquivo existe
        if (Storage::exists("arquivos/servicos/{$idUnidade}/{$anoAtual}/" . $fileName)) {
            // Deleta o arquivo
            Storage::delete("arquivos/servicos/{$idUnidade}/{$anoAtual}/" . $fileName);
            return "Arquivo $fileName deletado com sucesso!";
        } else {
            return "Arquivo $fileName não encontrado!";
        }
    }


    public function update(Request $request)
    {
        $formData = $request->all();
        $response = $this->servicoService->update($formData);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function destroy(Request $request)
    {
        $data = [
            'id' => trim($request->id),
            'status' => 'D'
        ];

        $servico = $this->servicoService->find($request->id);

        $response = $this->servicoService->destroy($data);

        if($response['status'] == 'success') {
            if ($servico['status'] == 'success'
                && !empty($servico['data'][0]->documento)
            ) {
                self::deletarArquivo($servico['data'][0]->documento);
            }

            return response()->json(['status'=>'success'], 200);
        }

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list()
    {
        $response = $this->servicoService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
