<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ParameterTypeService;

class ParameterTypeController extends Controller
{
    private $parameterTypeService;

    public function __construct(ParameterTypeService $parameterTypeService)
    {
        $this->parameterTypeService = $parameterTypeService;
    }

    public function index()
    {
        return view('parameter_type.home');
    }

    public function store(Request $request)
    {
        $data = [
            'id_unit' => auth()->user()->id_unit,
            'name' => trim($request->name)
        ];

        $response = $this->parameterTypeService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {
        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name)
        ];

        $response = $this->parameterTypeService->update($data);

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

        $response = $this->parameterTypeService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list()
    {
        $response = $this->parameterTypeService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
