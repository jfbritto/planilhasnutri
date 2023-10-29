<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaTrocaElementoFiltranteService;
use App\Services\HistoricoService;
use PDF;

class PlanilhaTrocaElementoFiltranteController extends Controller
{
    private $planilhaTrocaElementoFiltranteService;
    private $historicoService;
    private $idPlanilha = 1;

    public function __construct(PlanilhaTrocaElementoFiltranteService $planilhaTrocaElementoFiltranteService, HistoricoService $historicoService)
    {
        $this->planilhaTrocaElementoFiltranteService = $planilhaTrocaElementoFiltranteService;
        $this->historicoService = $historicoService;
    }

    public function index()
    {
        return view('planilha.troca_elemento_filtrante');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'id_parameter_area' => $request->id_parameter_area,
            'id_parameter_filtro' => $request->id_parameter_filtro,
            'id_parameter_responsavel' => $request->id_parameter_responsavel,
            'data_troca' => $request->data_troca,
            'data_proxima_troca' => $request->data_proxima_troca
        ];

        $response = $this->planilhaTrocaElementoFiltranteService->store($data);

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
            'id_parameter_area' => $request->id_parameter_area,
            'id_parameter_filtro' => $request->id_parameter_filtro,
            'id_parameter_responsavel' => $request->id_parameter_responsavel,
            'data_troca' => $request->data_troca,
            'data_proxima_troca' => $request->data_proxima_troca
        ];

        $response = $this->planilhaTrocaElementoFiltranteService->update($data);

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

        $response = $this->planilhaTrocaElementoFiltranteService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaTrocaElementoFiltranteService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaTrocaElementoFiltranteService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaTrocaElementoFiltranteService->list($filter)['data'];

        $titulo = "Controle de Troca do Elemento Filtrante";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.troca_elemento_filtrante', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('troca_elemento_filtrante.pdf');
    }
}
