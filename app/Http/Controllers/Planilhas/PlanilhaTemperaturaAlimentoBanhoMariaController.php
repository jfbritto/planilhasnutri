<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaTemperaturaAlimentoBanhoMariaService;

class PlanilhaTemperaturaAlimentoBanhoMariaController extends Controller
{
    private $planilhaTemperaturaAlimentoBanhoMariaService;

    public function __construct(PlanilhaTemperaturaAlimentoBanhoMariaService $planilhaTemperaturaAlimentoBanhoMariaService)
    {
        $this->planilhaTemperaturaAlimentoBanhoMariaService = $planilhaTemperaturaAlimentoBanhoMariaService;
    }

    public function index()
    {
        return view('planilha.temperatura_alimento_banho_maria');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'periodo' => $request->periodo,
            'id_parameter_produto' => $request->id_parameter_produto,
            'primeira_hora' => $request->primeira_hora,
            'primeira_tremperatura' => $request->primeira_tremperatura,
            'segunda_hora' => $request->segunda_hora,
            'segunda_tremperatura' => $request->segunda_tremperatura,
            'acao_corretiva' => $request->acao_corretiva
        ];

        $response = $this->planilhaTemperaturaAlimentoBanhoMariaService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {

        $data = [
            'id' => $request->id,
            'data' => $request->data,
            'periodo' => $request->periodo,
            'id_parameter_produto' => $request->id_parameter_produto,
            'primeira_hora' => $request->primeira_hora,
            'primeira_tremperatura' => $request->primeira_tremperatura,
            'segunda_hora' => $request->segunda_hora,
            'segunda_tremperatura' => $request->segunda_tremperatura,
            'acao_corretiva' => $request->acao_corretiva
        ];

        $response = $this->planilhaTemperaturaAlimentoBanhoMariaService->update($data);

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

        $response = $this->planilhaTemperaturaAlimentoBanhoMariaService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaTemperaturaAlimentoBanhoMariaService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaTemperaturaAlimentoBanhoMariaService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
