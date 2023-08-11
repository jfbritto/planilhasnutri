<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoService;

class PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoController extends Controller
{
    private $planilhaHigienizacaoFiltrosAparelhosClimatizacaoService;

    public function __construct(PlanilhaHigienizacaoFiltrosAparelhosClimatizacaoService $planilhaHigienizacaoFiltrosAparelhosClimatizacaoService)
    {
        $this->planilhaHigienizacaoFiltrosAparelhosClimatizacaoService = $planilhaHigienizacaoFiltrosAparelhosClimatizacaoService;
    }

    public function index()
    {
        return view('planilha.higienizacao_filtros_aparelhos_climatizacaos');
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

    public function list()
    {
        $response = $this->planilhaHigienizacaoFiltrosAparelhosClimatizacaoService->list();

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
}
