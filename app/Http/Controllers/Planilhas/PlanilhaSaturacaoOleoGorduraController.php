<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaSaturacaoOleoGorduraService;

class PlanilhaSaturacaoOleoGorduraController extends Controller
{
    private $planilhaSaturacaoOleoGorduraService;

    public function __construct(PlanilhaSaturacaoOleoGorduraService $planilhaSaturacaoOleoGorduraService)
    {
        $this->planilhaSaturacaoOleoGorduraService = $planilhaSaturacaoOleoGorduraService;
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
}
