<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaTemperaturaEquipamentoAreaClimatizadaService;
use PDF;

class PlanilhaTemperaturaEquipamentoAreaClimatizadaController extends Controller
{
    private $planilhaTemperaturaEquipamentoAreaClimatizadaService;

    public function __construct(PlanilhaTemperaturaEquipamentoAreaClimatizadaService $planilhaTemperaturaEquipamentoAreaClimatizadaService)
    {
        $this->planilhaTemperaturaEquipamentoAreaClimatizadaService = $planilhaTemperaturaEquipamentoAreaClimatizadaService;
    }

    public function index()
    {
        return view('planilha.temperatura_equipamento_area_climatizada');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'id_parameter_responsavel' => $request->id_parameter_responsavel,
            'id_parameter_equipamento' => $request->id_parameter_equipamento,
            'temperatura_1' => $request->temperatura_1,
            'temperatura_2' => $request->temperatura_2
        ];

        $response = $this->planilhaTemperaturaEquipamentoAreaClimatizadaService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {
        $data = [
            'id' => $request->id,
            'data' => $request->data,
            'id_parameter_responsavel' => $request->id_parameter_responsavel,
            'id_parameter_equipamento' => $request->id_parameter_equipamento,
            'temperatura_1' => $request->temperatura_1,
            'temperatura_2' => $request->temperatura_2
        ];

        $response = $this->planilhaTemperaturaEquipamentoAreaClimatizadaService->update($data);

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

        $response = $this->planilhaTemperaturaEquipamentoAreaClimatizadaService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaTemperaturaEquipamentoAreaClimatizadaService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaTemperaturaEquipamentoAreaClimatizadaService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaTemperaturaEquipamentoAreaClimatizadaService->list($filter)['data'];

        $titulo = "titulo";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.base', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('base.pdf');
    }
}
