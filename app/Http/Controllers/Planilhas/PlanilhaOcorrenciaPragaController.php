<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaOcorrenciaPragaService;
use PDF;

class PlanilhaOcorrenciaPragaController extends Controller
{
    private $planilhaOcorrenciaPragaService;

    public function __construct(PlanilhaOcorrenciaPragaService $planilhaOcorrenciaPragaService)
    {
        $this->planilhaOcorrenciaPragaService = $planilhaOcorrenciaPragaService;
    }

    public function index()
    {
        return view('planilha.ocorrencia_praga');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'id_parameter_area' => $request->id_parameter_area,
            'id_parameter_praga' => $request->id_parameter_praga,
            'observacoes' => $request->observacoes
        ];

        $response = $this->planilhaOcorrenciaPragaService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {
        $data = [
            'id' => $request->id,
            'data' => $request->data,
            'id_parameter_area' => $request->id_parameter_area,
            'id_parameter_praga' => $request->id_parameter_praga,
            'observacoes' => $request->observacoes
        ];

        $response = $this->planilhaOcorrenciaPragaService->update($data);

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

        $response = $this->planilhaOcorrenciaPragaService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaOcorrenciaPragaService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaOcorrenciaPragaService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaOcorrenciaPragaService->list($filter)['data'];

        $titulo = "Registro de Ocorrência de Pragas";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.ocorrencia_praga', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('ocorrencia_praga.pdf');
    }
}
