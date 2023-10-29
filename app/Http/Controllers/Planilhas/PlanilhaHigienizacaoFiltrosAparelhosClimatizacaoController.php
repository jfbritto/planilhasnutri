<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoService;
use App\Services\HistoricoService;
use PDF;

class PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController extends Controller
{
    private $planilhaHigienizacaoFiltrosAparelhosClimatizacaoService;
    private $historicoService;
    private $idPlanilha = 2;

    public function __construct(PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoService $planilhaHigienizacaoFiltrosAparelhosClimatizacaoService, HistoricoService $historicoService)
    {
        $this->planilhaHigienizacaoFiltrosAparelhosClimatizacaoService = $planilhaHigienizacaoFiltrosAparelhosClimatizacaoService;
        $this->historicoService = $historicoService;
    }

    public function index()
    {
        return view('planilha.higienizacao_filtros_aparelhos_climatizacao');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'id_parameter_area' => $request->id_parameter_area,
            'id_parameter_equipamento' => $request->id_parameter_equipamento,
            'id_parameter_responsavel' => $request->id_parameter_responsavel,
            'data_higienizacao' => $request->data_higienizacao,
            'data_proxima_higienizacao' => $request->data_proxima_higienizacao
        ];

        $response = $this->planilhaHigienizacaoFiltrosAparelhosClimatizacaoService->store($data);

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
            'id_parameter_equipamento' => $request->id_parameter_equipamento,
            'id_parameter_responsavel' => $request->id_parameter_responsavel,
            'data_higienizacao' => $request->data_higienizacao,
            'data_proxima_higienizacao' => $request->data_proxima_higienizacao
        ];

        $response = $this->planilhaHigienizacaoFiltrosAparelhosClimatizacaoService->update($data);

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

        $response = $this->planilhaHigienizacaoFiltrosAparelhosClimatizacaoService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaHigienizacaoFiltrosAparelhosClimatizacaoService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaHigienizacaoFiltrosAparelhosClimatizacaoService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaHigienizacaoFiltrosAparelhosClimatizacaoService->list($filter)['data'];

        $titulo = "Higienização dos Filtros e Aparelhos de Climatização";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.higienizacao_filtros_aparelhos_climatizacao', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('higienizacao_filtros_aparelhos_climatizacao.pdf');
    }
}
