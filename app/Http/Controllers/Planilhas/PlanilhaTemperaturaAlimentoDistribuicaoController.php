<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaTemperaturaAlimentoDistribuicaoService;
use PDF;

class PlanilhaTemperaturaAlimentoDistribuicaoController extends Controller
{
    private $planilhaTemperaturaAlimentoDistribuicaoService;

    public function __construct(PlanilhaTemperaturaAlimentoDistribuicaoService $planilhaTemperaturaAlimentoDistribuicaoService)
    {
        $this->planilhaTemperaturaAlimentoDistribuicaoService = $planilhaTemperaturaAlimentoDistribuicaoService;
    }

    public function index()
    {
        return view('planilha.temperatura_alimento_distribuicao');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'periodo' => $request->periodo,
            'id_parameter_produto' => $request->id_parameter_produto,
            'id_parameter_evento' => $request->id_parameter_evento,
            'id_parameter_responsavel' => $request->id_parameter_responsavel,
            'hora_1' => $request->hora_1,
            'tremperatura_1' => $request->tremperatura_1,
            'hora_2' => $request->hora_2,
            'tremperatura_2' => $request->tremperatura_2,
            'hora_3' => $request->hora_3,
            'tremperatura_3' => $request->tremperatura_3,
            'hora_4' => $request->hora_4,
            'tremperatura_4' => $request->tremperatura_4,
            'hora_5' => $request->hora_5,
            'tremperatura_5' => $request->tremperatura_5,
            'hora_6' => $request->hora_6,
            'tremperatura_6' => $request->tremperatura_6,
            'hora_7' => $request->hora_7,
            'tremperatura_7' => $request->tremperatura_7,
            'acao_corretiva' => $request->acao_corretiva
        ];

        $response = $this->planilhaTemperaturaAlimentoDistribuicaoService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {

        $data = [
            'id' => $request->id,
            'data' => $request->data,
            'periodo' => $request->periodo,
            'id_parameter_produto' => $request->id_parameter_produto,
            'id_parameter_evento' => $request->id_parameter_evento,
            'id_parameter_responsavel' => $request->id_parameter_responsavel,
            'hora_1' => $request->hora_1,
            'tremperatura_1' => $request->tremperatura_1,
            'hora_2' => $request->hora_2,
            'tremperatura_2' => $request->tremperatura_2,
            'hora_3' => $request->hora_3,
            'tremperatura_3' => $request->tremperatura_3,
            'hora_4' => $request->hora_4,
            'tremperatura_4' => $request->tremperatura_4,
            'hora_5' => $request->hora_5,
            'tremperatura_5' => $request->tremperatura_5,
            'hora_6' => $request->hora_6,
            'tremperatura_6' => $request->tremperatura_6,
            'hora_7' => $request->hora_7,
            'tremperatura_7' => $request->tremperatura_7,
            'acao_corretiva' => $request->acao_corretiva
        ];

        $response = $this->planilhaTemperaturaAlimentoDistribuicaoService->update($data);

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

        $response = $this->planilhaTemperaturaAlimentoDistribuicaoService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaTemperaturaAlimentoDistribuicaoService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaTemperaturaAlimentoDistribuicaoService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaTemperaturaAlimentoDistribuicaoService->list($filter)['data'];

        $titulo = "titulo";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.base', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('base.pdf');
    }
}
