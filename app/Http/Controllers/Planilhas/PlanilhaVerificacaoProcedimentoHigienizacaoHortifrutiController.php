<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiService;

class PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiController extends Controller
{
    private $planilhaVerificacaoProcedimentoHigienizacaoHortifrutiService;

    public function __construct(PlanilhaVerificacaoProcedimentoHigienizacaoHortifrutiService $planilhaVerificacaoProcedimentoHigienizacaoHortifrutiService)
    {
        $this->planilhaVerificacaoProcedimentoHigienizacaoHortifrutiService = $planilhaVerificacaoProcedimentoHigienizacaoHortifrutiService;
    }

    public function index()
    {
        return view('planilha.verificacao_procedimento_higienizacao_hortifruti');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'id_parameter_alimento' => $request->id_parameter_alimento,
            'hora_imersao_inicio' => $request->hora_imersao_inicio,
            'hora_imersao_fim' => $request->hora_imersao_fim,
            'concentracao_solucao_clorada' => $request->concentracao_solucao_clorada,
            'acao_corretiva' => $request->acao_corretiva,
            'id_parameter_responsavel' => $request->id_parameter_responsavel
        ];

        $response = $this->planilhaVerificacaoProcedimentoHigienizacaoHortifrutiService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {

        $data = [
            'id' => $request->id,
            'data' => $request->data,
            'id_parameter_alimento' => $request->id_parameter_alimento,
            'hora_imersao_inicio' => $request->hora_imersao_inicio,
            'hora_imersao_fim' => $request->hora_imersao_fim,
            'concentracao_solucao_clorada' => $request->concentracao_solucao_clorada,
            'acao_corretiva' => $request->acao_corretiva,
            'id_parameter_responsavel' => $request->id_parameter_responsavel
        ];

        $response = $this->planilhaVerificacaoProcedimentoHigienizacaoHortifrutiService->update($data);

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

        $response = $this->planilhaVerificacaoProcedimentoHigienizacaoHortifrutiService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list()
    {
        $response = $this->planilhaVerificacaoProcedimentoHigienizacaoHortifrutiService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaVerificacaoProcedimentoHigienizacaoHortifrutiService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
