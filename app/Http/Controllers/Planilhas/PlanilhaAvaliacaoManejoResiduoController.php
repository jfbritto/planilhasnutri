<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaAvaliacaoManejoResiduoService;
use PDF;

class PlanilhaAvaliacaoManejoResiduoController extends Controller
{
    private $planilhaAvaliacaoManejoResiduoService;

    public function __construct(PlanilhaAvaliacaoManejoResiduoService $planilhaAvaliacaoManejoResiduoService)
    {
        $this->planilhaAvaliacaoManejoResiduoService = $planilhaAvaliacaoManejoResiduoService;
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

        $titulo = "titulo";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.base', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('base.pdf');
    }
}
