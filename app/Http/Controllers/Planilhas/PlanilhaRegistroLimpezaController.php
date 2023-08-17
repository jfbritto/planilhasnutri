<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaRegistroLimpezaService;

class PlanilhaRegistroLimpezaController extends Controller
{
    private $planilhaRegistroLimpezaService;

    public function __construct(PlanilhaRegistroLimpezaService $planilhaRegistroLimpezaService)
    {
        $this->planilhaRegistroLimpezaService = $planilhaRegistroLimpezaService;
    }

    public function index()
    {
        return view('planilha.planilha_registro_limpeza');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'id_parameter_responsavel' => $request->id_parameter_responsavel,
            'id_parameter_local' => $request->id_parameter_local,
            'superficie_limpa' => $request->superficie_limpa,
            'frequencia' => $request->frequencia,
            'conforme_naoconforme' => $request->conforme_naoconforme,
            'comentarios' => $request->comentarios
        ];

        $response = $this->planilhaRegistroLimpezaService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {

        $data = [
            'id' => $request->id,
            'data' => $request->data,
            'id_parameter_responsavel' => $request->id_parameter_responsavel,
            'id_parameter_local' => $request->id_parameter_local,
            'superficie_limpa' => $request->superficie_limpa,
            'frequencia' => $request->frequencia,
            'conforme_naoconforme' => $request->conforme_naoconforme,
            'comentarios' => $request->comentarios
        ];

        $response = $this->planilhaRegistroLimpezaService->update($data);

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

        $response = $this->planilhaRegistroLimpezaService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list()
    {
        $response = $this->planilhaRegistroLimpezaService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaRegistroLimpezaService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
