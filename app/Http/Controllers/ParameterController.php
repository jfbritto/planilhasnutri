<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ParameterService;

class ParameterController extends Controller
{
    private $parameterService;

    public function __construct(ParameterService $parameterService)
    {
        $this->parameterService = $parameterService;
    }

    public function index()
    {
        return view('parameter.home');
    }

    public function store(Request $request)
    {
        $data = [
            'name' => self::capitalizarPrimeirasLetras(trim($request->name)),
            'id_unit' => auth()->user()->id_unit,
            'id_parameter_type' => $request->id_parameter_type
        ];

        $filter['id_parameter_type'] = $data['id_parameter_type'];
        $filter['name'] = $data['name'];
        $response = $this->parameterService->list($filter);

        if (!empty($response['data'])) {
            return response()->json(['status'=>'error', 'message'=>'Já existe um item cadastrado com esse nome!'], 400);
        }

        $response = $this->parameterService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data' => $response], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {

        $data = [
            'id' => trim($request->id),
            'name' => self::capitalizarPrimeirasLetras(trim($request->name))
        ];

        $response = $this->parameterService->update($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function capitalizarPrimeirasLetras($texto) {
        return mb_convert_case($texto, MB_CASE_TITLE, 'UTF-8');
    }

    public function destroy(Request $request)
    {
        $data = [
            'id' => trim($request->id),
            'status' => 'D'
        ];

        $response = $this->parameterService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->parameterService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->parameterService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
