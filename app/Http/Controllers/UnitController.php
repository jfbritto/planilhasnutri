<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UnitService;

class UnitController extends Controller
{
    private $unitService;

    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    public function index()
    {
        return view('unit.home');
    }

    public function store(Request $request)
    {
        $data = [
            'name' => trim($request->name),
            'city' => trim($request->city),
            'neighborhood' => trim($request->neighborhood),
            'description' => trim($request->description)
        ];

        $response = $this->unitService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {
        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name),
            'city' => trim($request->city),
            'neighborhood' => trim($request->neighborhood),
            'description' => trim($request->description)
        ];

        $response = $this->unitService->update($data);

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

        $response = $this->unitService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list()
    {
        $response = $this->unitService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
