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
            'name' => trim($request->name),
            'id_unit' => auth()->user()->id_unit,
            'id_parameter_type' => $request->id_parameter_type
        ];

        $response = $this->parameterService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data' => $response], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {

        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name)
        ];

        $response = $this->parameterService->update($data);

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

        $response = $this->parameterService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list()
    {
        $response = $this->parameterService->list();

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
