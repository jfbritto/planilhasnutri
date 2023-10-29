<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaAvaliacaoManejoResiduoService;
use App\Services\HistoricoService;
use PDF;

class PlanilhaAvaliacaoManejoResiduoController extends Controller
{
    private $planilhaAvaliacaoManejoResiduoService;
    private $historicoService;
    private $idPlanilha = 16;

    public function __construct(PlanilhaAvaliacaoManejoResiduoService $planilhaAvaliacaoManejoResiduoService, HistoricoService $historicoService)
    {
        $this->planilhaAvaliacaoManejoResiduoService = $planilhaAvaliacaoManejoResiduoService;
        $this->historicoService = $historicoService;
    }

    public function index()
    {
        return view('planilha.avaliacao_manejo_residuo');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'lixeira_apropriada' => $request->lixeira_apropriada,
            'retirada_conforme' => $request->retirada_conforme,
            'manipuladores_treinados' => $request->manipuladores_treinados,
            'area_externa_apropriada' => $request->area_externa_apropriada,
            'residuos_organicos_retirados' => $request->residuos_organicos_retirados,
            'area_externa_higienizada' => $request->area_externa_higienizada,
            'observacoes' => $request->observacoes,
        ];

        $response = $this->planilhaAvaliacaoManejoResiduoService->store($data);

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
            'lixeira_apropriada' => $request->lixeira_apropriada,
            'retirada_conforme' => $request->retirada_conforme,
            'manipuladores_treinados' => $request->manipuladores_treinados,
            'area_externa_apropriada' => $request->area_externa_apropriada,
            'residuos_organicos_retirados' => $request->residuos_organicos_retirados,
            'area_externa_higienizada' => $request->area_externa_higienizada,
            'observacoes' => $request->observacoes,
        ];

        $response = $this->planilhaAvaliacaoManejoResiduoService->update($data);

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

        $response = $this->planilhaAvaliacaoManejoResiduoService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaAvaliacaoManejoResiduoService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaAvaliacaoManejoResiduoService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaAvaliacaoManejoResiduoService->list($filter)['data'];

        $titulo = "Check-list de Avaliação do Manejo dos Resíduos";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.avaliacao_manejo_residuo', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('avaliacao_manejo_residuo.pdf');
    }
}
