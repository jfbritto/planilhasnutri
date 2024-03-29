<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaSaturacaoOleoGorduraService;
use App\Services\HistoricoService;
use PDF;

class PlanilhaSaturacaoOleoGorduraController extends Controller
{
    private $planilhaSaturacaoOleoGorduraService;
    private $historicoService;
    private $idPlanilha = 3;

    public function __construct(PlanilhaSaturacaoOleoGorduraService $planilhaSaturacaoOleoGorduraService, HistoricoService $historicoService)
    {
        $this->planilhaSaturacaoOleoGorduraService = $planilhaSaturacaoOleoGorduraService;
        $this->historicoService = $historicoService;
    }

    public function index()
    {
        return view('planilha.saturacao_oleo_gordura');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'id_parameter_area' => $request->id_parameter_area,
            'id_parameter_equipamento' => $request->id_parameter_equipamento,
            'id_parameter_status_equipamento' => $request->id_parameter_status_equipamento,
            'hora_primeira_afericao' => $request->hora_primeira_afericao,
            'temperatura_primeira_afericao' => $request->temperatura_primeira_afericao,
            'hora_segunda_afericao' => $request->hora_segunda_afericao,
            'temperatura_segunda_afericao' => $request->temperatura_segunda_afericao,
            'acao_corretiva' => $request->acao_corretiva,
            'id_parameter_responsavel_acao' => $request->id_parameter_responsavel_acao,
            'leitura_fita' => $request->leitura_fita,
            'situacao_gordura' => $request->situacao_gordura,
            'id_parameter_responsavel' => $request->id_parameter_responsavel
        ];

        $response = $this->planilhaSaturacaoOleoGorduraService->store($data);

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
            'id_parameter_area' => $request->id_parameter_area,
            'id_parameter_equipamento' => $request->id_parameter_equipamento,
            'id_parameter_status_equipamento' => $request->id_parameter_status_equipamento,
            'hora_primeira_afericao' => $request->hora_primeira_afericao,
            'temperatura_primeira_afericao' => $request->temperatura_primeira_afericao,
            'hora_segunda_afericao' => $request->hora_segunda_afericao,
            'temperatura_segunda_afericao' => $request->temperatura_segunda_afericao,
            'acao_corretiva' => $request->acao_corretiva,
            'id_parameter_responsavel_acao' => $request->id_parameter_responsavel_acao,
            'leitura_fita' => $request->leitura_fita,
            'situacao_gordura' => $request->situacao_gordura,
            'id_parameter_responsavel' => $request->id_parameter_responsavel
        ];

        $response = $this->planilhaSaturacaoOleoGorduraService->update($data);

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

        $response = $this->planilhaSaturacaoOleoGorduraService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaSaturacaoOleoGorduraService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaSaturacaoOleoGorduraService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaSaturacaoOleoGorduraService->list($filter)['data'];

        $titulo = "Controle de Saturação de Óleos e Gorduras";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.saturacao_oleo_gordura', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('saturacao_oleo_gordura.pdf');
    }
}
