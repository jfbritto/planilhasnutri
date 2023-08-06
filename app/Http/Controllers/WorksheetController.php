<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WorksheetService;

class WorksheetController extends Controller
{
    private $worksheetService;

    public function __construct(WorksheetService $worksheetService)
    {
        $this->worksheetService = $worksheetService;
    }

    public function index()
    {
        return view('worksheet.home');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'id_unit' => auth()->user()->id_unit,
            'id_worksheet_structure' => trim($request->id_worksheet_structure),
            'description' => trim($request->description)
        ];

        $response = $this->worksheetService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {

        $data = [
            'id' => trim($request->id),
            'description' => trim($request->description)
        ];

        $response = $this->worksheetService->update($data);

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

        $response = $this->worksheetService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list()
    {
        $response = $this->worksheetService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
