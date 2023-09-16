<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaReaquecimentoAlimentoService;

class PlanilhaReaquecimentoAlimentoController extends Controller
{
    private $planilhaReaquecimentoAlimentoService;

    public function __construct(PlanilhaReaquecimentoAlimentoService $planilhaReaquecimentoAlimentoService)
    {
        $this->planilhaReaquecimentoAlimentoService = $planilhaReaquecimentoAlimentoService;
    }

    public function index()
    {
        return view('planilha.reaquecimento_alimento');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'id_parameter_produto' => $request->id_parameter_produto,
            'hora_temperatura_antes' => $request->hora_temperatura_antes,
            'temperatura_antes' => $request->temperatura_antes,
            'hora_temperatura_depois' => $request->hora_temperatura_depois,
            'temperatura_depois' => $request->temperatura_depois,
            'tempo_aquecimento' => $request->tempo_aquecimento,
            'conforme_naoconforme' => $request->conforme_naoconforme,
            'id_parameter_responsavel' => $request->id_parameter_responsavel
        ];

        $response = $this->planilhaReaquecimentoAlimentoService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {

        $data = [
            'id' => $request->id,
            'data' => $request->data,
            'id_parameter_produto' => $request->id_parameter_produto,
            'hora_temperatura_antes' => $request->hora_temperatura_antes,
            'temperatura_antes' => $request->temperatura_antes,
            'hora_temperatura_depois' => $request->hora_temperatura_depois,
            'temperatura_depois' => $request->temperatura_depois,
            'tempo_aquecimento' => $request->tempo_aquecimento,
            'conforme_naoconforme' => $request->conforme_naoconforme,
            'id_parameter_responsavel' => $request->id_parameter_responsavel
        ];

        $response = $this->planilhaReaquecimentoAlimentoService->update($data);

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

        $response = $this->planilhaReaquecimentoAlimentoService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list()
    {
        $response = $this->planilhaReaquecimentoAlimentoService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaReaquecimentoAlimentoService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
