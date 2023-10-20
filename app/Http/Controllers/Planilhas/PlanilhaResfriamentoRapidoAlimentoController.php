<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaResfriamentoRapidoAlimentoService;
use PDF;

class PlanilhaResfriamentoRapidoAlimentoController extends Controller
{
    private $planilhaResfriamentoRapidoAlimentoService;

    public function __construct(PlanilhaResfriamentoRapidoAlimentoService $planilhaResfriamentoRapidoAlimentoService)
    {
        $this->planilhaResfriamentoRapidoAlimentoService = $planilhaResfriamentoRapidoAlimentoService;
    }

    public function index()
    {
        return view('planilha.resfriamento_rapido_alimento');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'id_parameter_produto' => $request->id_parameter_produto,
            'cozimento_hora_final' => $request->cozimento_hora_final,
            'cozimento_temperatura_interna' => $request->cozimento_temperatura_interna,
            'resfriamento_hora_inicio' => $request->resfriamento_hora_inicio,
            'resfriamento_temperatura_central_inicio' => $request->resfriamento_temperatura_central_inicio,
            'resfriamento_hora_fim' => $request->resfriamento_hora_fim,
            'resfriamento_temperatura_central_fim' => $request->resfriamento_temperatura_central_fim,
            'conforme_naoconforme' => $request->conforme_naoconforme,
            'id_parameter_responsavel' => $request->id_parameter_responsavel
        ];

        $response = $this->planilhaResfriamentoRapidoAlimentoService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {

        $data = [
            'id' => $request->id,
            'data' => $request->data,
            'id_parameter_produto' => $request->id_parameter_produto,
            'cozimento_hora_final' => $request->cozimento_hora_final,
            'cozimento_temperatura_interna' => $request->cozimento_temperatura_interna,
            'resfriamento_hora_inicio' => $request->resfriamento_hora_inicio,
            'resfriamento_temperatura_central_inicio' => $request->resfriamento_temperatura_central_inicio,
            'resfriamento_hora_fim' => $request->resfriamento_hora_fim,
            'resfriamento_temperatura_central_fim' => $request->resfriamento_temperatura_central_fim,
            'conforme_naoconforme' => $request->conforme_naoconforme,
            'id_parameter_responsavel' => $request->id_parameter_responsavel
        ];

        $response = $this->planilhaResfriamentoRapidoAlimentoService->update($data);

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

        $response = $this->planilhaResfriamentoRapidoAlimentoService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaResfriamentoRapidoAlimentoService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaResfriamentoRapidoAlimentoService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaResfriamentoRapidoAlimentoService->list($filter)['data'];

        $titulo = "titulo";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.base', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('base.pdf');
    }
}
