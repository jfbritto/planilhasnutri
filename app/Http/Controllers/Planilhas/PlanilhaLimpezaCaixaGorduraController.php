<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaLimpezaCaixaGorduraService;
use App\Services\HistoricoService;
use PDF;

class PlanilhaLimpezaCaixaGorduraController extends Controller
{
    private $planilhaLimpezaCaixaGorduraService;
    private $historicoService;
    private $idPlanilha = 4;

    public function __construct(PlanilhaLimpezaCaixaGorduraService $planilhaLimpezaCaixaGorduraService, HistoricoService $historicoService)
    {
        $this->planilhaLimpezaCaixaGorduraService = $planilhaLimpezaCaixaGorduraService;
        $this->historicoService = $historicoService;
    }

    public function index()
    {
        return view('planilha.limpeza_caixa_gorduras');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'id_parameter_caixa_gordura' => $request->id_parameter_caixa_gordura,
            'id_parameter_area' => $request->id_parameter_area,
            'id_parameter_responsavel' => $request->id_parameter_responsavel,
            'data_limpeza' => $request->data_limpeza,
            'data_proxima_limpeza' => $request->data_proxima_limpeza
        ];

        $response = $this->planilhaLimpezaCaixaGorduraService->store($data);

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
            'id_parameter_caixa_gordura' => $request->id_parameter_caixa_gordura,
            'id_parameter_area' => $request->id_parameter_area,
            'id_parameter_responsavel' => $request->id_parameter_responsavel,
            'data_limpeza' => $request->data_limpeza,
            'data_proxima_limpeza' => $request->data_proxima_limpeza
        ];

        $response = $this->planilhaLimpezaCaixaGorduraService->update($data);

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

        $response = $this->planilhaLimpezaCaixaGorduraService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaLimpezaCaixaGorduraService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaLimpezaCaixaGorduraService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaLimpezaCaixaGorduraService->list($filter)['data'];

        $titulo = "Registro de Limpeza de Caixa de Gordura";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.limpeza_caixa_gorduras', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('limpeza_caixa_gorduras.pdf');
    }
}
