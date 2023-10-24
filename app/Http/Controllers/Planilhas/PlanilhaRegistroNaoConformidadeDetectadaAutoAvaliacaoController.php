<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoService;
use PDF;

class PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoController extends Controller
{
    private $planilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoService;

    public function __construct(PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoService $planilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoService)
    {
        $this->planilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoService = $planilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoService;
    }

    public function index()
    {
        return view('planilha.registro_nao_conformidade_detectada_auto_avaliacao');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'nao_conformidade' => $request->nao_conformidade,
            'possiveis_causas' => $request->possiveis_causas,
            'tratamento_produto' => $request->tratamento_produto,
            'acoes_corretivas' => $request->acoes_corretivas,
            'id_parameter_responsavel' => $request->id_parameter_responsavel
        ];

        $response = $this->planilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {

        $data = [
            'id' => $request->id,
            'data' => $request->data,
            'nao_conformidade' => $request->nao_conformidade,
            'possiveis_causas' => $request->possiveis_causas,
            'tratamento_produto' => $request->tratamento_produto,
            'acoes_corretivas' => $request->acoes_corretivas,
            'id_parameter_responsavel' => $request->id_parameter_responsavel
        ];

        $response = $this->planilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoService->update($data);

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

        $response = $this->planilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaRegistroNaoConformidadeDetectadaAutoAvaliacaoService->list($filter)['data'];

        $titulo = "Registro de Não Conformidades Detectadas da Auto Avaliação";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.registro_nao_conformidade_detectada_auto_avaliacao', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('registro_nao_conformidade_detectada_auto_avaliacao.pdf');
    }
}
