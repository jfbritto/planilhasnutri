<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HistoricoService;

class HistoricoController extends Controller
{
    private $historicoService;

    public function __construct(HistoricoService $historicoService)
    {
        $this->historicoService = $historicoService;
    }

    public function index()
    {
        return view('historico.home');
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->historicoService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
