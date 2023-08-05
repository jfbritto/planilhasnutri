<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WorksheetStructureService;

class WorksheetStructureController extends Controller
{
    private $worksheetStructureService;

    public function __construct(WorksheetStructureService $worksheetStructureService)
    {
        $this->worksheetStructureService = $worksheetStructureService;
    }

    public function index()
    {
        return view('worksheet_structure.home');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'name' => trim($request->name),
            'description' => trim($request->description)
        ];

        $response = $this->worksheetStructureService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {
        $data = [
            'id' => trim($request->id),
            'name' => trim($request->name),
            'description' => trim($request->description)
        ];

        $response = $this->worksheetStructureService->update($data);

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

        $response = $this->worksheetStructureService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list()
    {
        $response = $this->worksheetStructureService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
