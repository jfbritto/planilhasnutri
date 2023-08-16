<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaTrocaElementoFiltranteService;

class PlanilhaTrocaElementoFiltranteController extends Controller
{
    private $planilhaTrocaElementoFiltranteService;

    public function __construct(PlanilhaTrocaElementoFiltranteService $planilhaTrocaElementoFiltranteService)
    {
        $this->planilhaTrocaElementoFiltranteService = $planilhaTrocaElementoFiltranteService;
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

    public function list()
    {
        $response = $this->planilhaTrocaElementoFiltranteService->list();

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
}