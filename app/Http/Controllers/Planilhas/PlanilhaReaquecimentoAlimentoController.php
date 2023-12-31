<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaReaquecimentoAlimentoService;
use App\Services\HistoricoService;
use PDF;

class PlanilhaReaquecimentoAlimentoController extends Controller
{
    private $planilhaReaquecimentoAlimentoService;
    private $historicoService;
    private $idPlanilha = 11;

    public function __construct(PlanilhaReaquecimentoAlimentoService $planilhaReaquecimentoAlimentoService, HistoricoService $historicoService)
    {
        $this->planilhaReaquecimentoAlimentoService = $planilhaReaquecimentoAlimentoService;
        $this->historicoService = $historicoService;
    }

    public function index()
    {
        return view('planilha.reaquecimento_alimento');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'id_parameter_produto' => $request->id_parameter_produto,
            'hora_temperatura_antes' => $request->hora_temperatura_antes,
            'temperatura_antes' => $request->temperatura_antes,
            'hora_temperatura_depois' => $request->hora_temperatura_depois,
            'temperatura_depois' => $request->temperatura_depois,
            'tempo_aquecimento' => $request->tempo_aquecimento,
            'conforme_naoconforme' => $request->conforme_naoconforme,
            'id_parameter_responsavel' => $request->id_parameter_responsavel
        ];

        $response = $this->planilhaReaquecimentoAlimentoService->store($data);

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
            'id_parameter_produto' => $request->id_parameter_produto,
            'hora_temperatura_antes' => $request->hora_temperatura_antes,
            'temperatura_antes' => $request->temperatura_antes,
            'hora_temperatura_depois' => $request->hora_temperatura_depois,
            'temperatura_depois' => $request->temperatura_depois,
            'tempo_aquecimento' => $request->tempo_aquecimento,
            'conforme_naoconforme' => $request->conforme_naoconforme,
            'id_parameter_responsavel' => $request->id_parameter_responsavel
        ];

        $response = $this->planilhaReaquecimentoAlimentoService->update($data);

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

        $response = $this->planilhaReaquecimentoAlimentoService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaReaquecimentoAlimentoService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaReaquecimentoAlimentoService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaReaquecimentoAlimentoService->list($filter)['data'];

        $titulo = "Controle de Reaquecimento dos Alimentos";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.reaquecimento_alimento', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('reaquecimento_alimento.pdf');
    }
}
