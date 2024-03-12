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

        // Remove caracteres especiais do nome do arquivo
        $nomeFormatado = preg_replace('/[^A-Za-z0-9]/', '', $nomeOriginal);

        // Concatena o nome formatado com a extensão do arquivo
        $fileName = md5(time().$nomeFormatado). '.' . $extensao;

        // Verifica se a pasta 'documentos' existe. Se não, cria a pasta.
        if (!Storage::exists('documentos')) {
            Storage::makeDirectory('documentos');
        }

        $documento->storeAs('documentos', $fileName);
        return $fileName;
    }

    public function downloadArquivo($fileName)
    {
        $caminhoArquivo = storage_path('app/documentos/' . $fileName);

        // Verifica se o arquivo existe
        if (!Storage::exists('documentos/' . $fileName)) {
            abort(404); // Se o arquivo não existir, retorna um erro 404
        }

        // Obtém o tipo de conteúdo (MIME type) do arquivo
        $mimeType = Storage::mimeType('documentos/' . $fileName);

        // Define os cabeçalhos da resposta
        $headers = [
            'Content-Type' => $mimeType,
        ];

        // Retorna uma resposta de download
        return response()->download($caminhoArquivo, $fileName, $headers);
    }

    public function deletarArquivo($fileName)
    {
        // Verifica se o arquivo existe
        if (Storage::exists('documentos/' . $fileName)) {
            // Deleta o arquivo
            Storage::delete('documentos/' . $fileName);
            return "Arquivo $fileName deletado com sucesso!";
        } else {
            return "Arquivo $fileName não encontrado!";
        }
    }


    public function update(Request $request)
    {
        $data = [
            'id' => $request->id,
            'id_parameter_servico' => $request->id_parameter_servico,
            'data' => $request->data,
            'proxima_data' => $request->proxima_data,
            'frequencia_meses' => $request->frequencia_meses,
            'documento' => $request->documento,
        ];

        $response = $this->servicoService->update($data);

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

        $response = $this->servicoService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

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
