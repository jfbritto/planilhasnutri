<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaRastreabilidadeDiariaService;
use PDF;
use Illuminate\Support\Facades\Storage;

class PlanilhaRastreabilidadeDiariaController extends Controller
{
    private $planilhaRastreabilidadeDiariaService;
    private $idPlanilha = 19;

    public function __construct(PlanilhaRastreabilidadeDiariaService $planilhaRastreabilidadeDiariaService) {
        $this->planilhaRastreabilidadeDiariaService = $planilhaRastreabilidadeDiariaService;
    }

    public function index()
    {
        return view('planilha.rastreabilidade_diaria');
    }

    public function store(Request $request)
    {
        $fileName = '';
        $image = $request->file('image');
        if (!empty($image)) {
            $fileName = $this->uploadDocumento($image);
        }

        $data = [
            'id_user' => auth()->user()->id,
            'id_parameter_produto' => $request->id_parameter_produto,
            'data' => $request->data,
            'lote' => $request->lote,
            'validade' => $request->validade,
            'id_parameter_fabricante' => $request->id_parameter_fabricante,
            'image' => $fileName
        ];

        $response = $this->planilhaRastreabilidadeDiariaService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {

        $data = [
            'id' => $request->id,
            'id_parameter_produto' => $request->id_parameter_produto,
            'data' => $request->data,
            'lote' => $request->lote,
            'validade' => $request->validade,
            'id_parameter_fabricante' => $request->id_parameter_fabricante
        ];

        $response = $this->planilhaRastreabilidadeDiariaService->update($data);

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

        $planilha = $this->planilhaRastreabilidadeDiariaService->find($request->id);

        $response = $this->planilhaRastreabilidadeDiariaService->destroy($data);

        if ($response['status'] == 'success') {
            if ($planilha['status'] == 'success'
                && !empty($planilha['data'][0]->image)
            ) {
                self::deletarArquivo($planilha['data'][0]->image);
            }

            return response()->json(['status'=>'success'], 200);
        }

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaRastreabilidadeDiariaService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaRastreabilidadeDiariaService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaRastreabilidadeDiariaService->list($filter)['data'];

        $titulo = "Rastreabilidade Diária";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.rastreabilidade_diaria', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('rastreabilidade_diaria.pdf');
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
        if (!Storage::exists("arquivos/planilhas/rastreabilidade/{$idUnidade}/{$anoAtual}")) {
            Storage::makeDirectory("arquivos/planilhas/rastreabilidade/{$idUnidade}/{$anoAtual}");
        }

        $documento->storeAs("arquivos/planilhas/rastreabilidade/{$idUnidade}/{$anoAtual}", $fileName);
        return $fileName;
    }

    public function downloadArquivo($fileName)
    {
        $idUnidade = auth()->user()->id_unit;
        $anoAtual = date('Y');

        $caminhoArquivo = storage_path("app/arquivos/planilhas/rastreabilidade/{$idUnidade}/{$anoAtual}/" . $fileName);

        // Verifica se o arquivo existe
        if (!Storage::exists("arquivos/planilhas/rastreabilidade/{$idUnidade}/{$anoAtual}/" . $fileName)) {
            abort(404); // Se o arquivo não existir, retorna um erro 404
        }

        // Obtém o tipo de conteúdo (MIME type) do arquivo
        $mimeType = Storage::mimeType("arquivos/planilhas/rastreabilidade/{$idUnidade}/{$anoAtual}/" . $fileName);

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
        if (Storage::exists("arquivos/planilhas/rastreabilidade/{$idUnidade}/{$anoAtual}/" . $fileName)) {
            // Deleta o arquivo
            Storage::delete("arquivos/planilhas/rastreabilidade/{$idUnidade}/{$anoAtual}/" . $fileName);
            return "Arquivo $fileName deletado com sucesso!";
        } else {
            return "Arquivo $fileName não encontrado!";
        }
    }
}
