<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PlanilhaTrocaElementoFiltranteService;

class HomeController extends Controller
{
    private $planilhaTrocaElementoFiltranteService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PlanilhaTrocaElementoFiltranteService $planilhaTrocaElementoFiltranteService)
    {
        $this->middleware('auth');

        $this->planilhaTrocaElementoFiltranteService = $planilhaTrocaElementoFiltranteService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaTrocaElementoFiltranteService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
