<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaGrupoAmostraPratoService;

class PlanilhaGrupoAmostraPratoController extends Controller
{
    private $planilhaGrupoAmostraPratoService;

    public function __construct(PlanilhaGrupoAmostraPratoService $planilhaGrupoAmostraPratoService)
    {
        $this->planilhaGrupoAmostraPratoService = $planilhaGrupoAmostraPratoService;
    }

    public function index()
    {
        return view('planilha.grupo_amostra_prato');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'nome_grupo' => $request->nome_grupo,
            'numero_pessoas' => $request->numero_pessoas,
            'cardapio' => $request->cardapio,
        ];

        $response = $this->planilhaGrupoAmostraPratoService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {

        $data = [
            'id' => $request->id,
            'data' => $request->data,
            'nome_grupo' => $request->nome_grupo,
            'numero_pessoas' => $request->numero_pessoas,
            'cardapio' => $request->cardapio,
        ];

        $response = $this->planilhaGrupoAmostraPratoService->update($data);

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

        $response = $this->planilhaGrupoAmostraPratoService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list()
    {
        $response = $this->planilhaGrupoAmostraPratoService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaGrupoAmostraPratoService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
