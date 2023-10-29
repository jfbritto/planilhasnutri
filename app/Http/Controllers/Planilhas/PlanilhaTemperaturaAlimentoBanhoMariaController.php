<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaTemperaturaAlimentoBanhoMariaService;
use App\Services\HistoricoService;
use PDF;

class PlanilhaTemperaturaAlimentoBanhoMariaController extends Controller
{
    private $planilhaTemperaturaAlimentoBanhoMariaService;
    private $historicoService;
    private $idPlanilha = 13;

    public function __construct(PlanilhaTemperaturaAlimentoBanhoMariaService $planilhaTemperaturaAlimentoBanhoMariaService, HistoricoService $historicoService)
    {
        $this->planilhaTemperaturaAlimentoBanhoMariaService = $planilhaTemperaturaAlimentoBanhoMariaService;
        $this->historicoService = $historicoService;
    }

    public function index()
    {
        return view('planilha.temperatura_alimento_banho_maria');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'periodo' => $request->periodo,
            'id_parameter_produto' => $request->id_parameter_produto,
            'primeira_hora' => $request->primeira_hora,
            'primeira_temperatura' => $request->primeira_temperatura,
            'segunda_hora' => $request->segunda_hora,
            'segunda_temperatura' => $request->segunda_temperatura,
            'acao_corretiva' => $request->acao_corretiva
        ];

        $response = $this->planilhaTemperaturaAlimentoBanhoMariaService->store($data);

        if ($response['status'] == 'success') {

            $historico = [
                'data' => date('Y-m-d H:i:s'),
                'id_user' => auth()->user()->id,
                'id_unit' => auth()->user()->id_unit,
                'id_planilha' => $this->idPlanilha,
                'id_planilha_registro' => $response["data"]->id,
                'acao' => "Planilha cadastrada",
            ];

            $this->historicoService->store($historico);
        }

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
            'primeira_hora' => $request->primeira_hora,
            'primeira_temperatura' => $request->primeira_temperatura,
            'segunda_hora' => $request->segunda_hora,
            'segunda_temperatura' => $request->segunda_temperatura,
            'acao_corretiva' => $request->acao_corretiva
        ];

        $response = $this->planilhaTemperaturaAlimentoBanhoMariaService->update($data);

        if ($response['status'] == 'success') {

            $historico = [
                'data' => date('Y-m-d H:i:s'),
                'id_user' => auth()->user()->id,
                'id_unit' => auth()->user()->id_unit,
                'id_planilha' => $this->idPlanilha,
                'id_planilha_registro' => $request->id,
                'acao' => "Planilha editada",
            ];

            $this->historicoService->store($historico);
        }

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

        $response = $this->planilhaTemperaturaAlimentoBanhoMariaService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaTemperaturaAlimentoBanhoMariaService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaTemperaturaAlimentoBanhoMariaService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaTemperaturaAlimentoBanhoMariaService->list($filter)['data'];

        $titulo = "Controle de Temperatura dos Alimentos no Banho-Maria";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.temperatura_alimento_banho_maria', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('temperatura_alimento_banho_maria.pdf');
    }
}
