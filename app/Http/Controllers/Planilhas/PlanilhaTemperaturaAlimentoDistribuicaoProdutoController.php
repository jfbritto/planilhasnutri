<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaTemperaturaAlimentoDistribuicaoProdutoService;

class PlanilhaTemperaturaAlimentoDistribuicaoProdutoController extends Controller
{
    private $planilhaTemperaturaAlimentoDistribuicaoProdutoService;

    public function __construct(PlanilhaTemperaturaAlimentoDistribuicaoProdutoService $planilhaTemperaturaAlimentoDistribuicaoProdutoService)
    {
        $this->planilhaTemperaturaAlimentoDistribuicaoProdutoService = $planilhaTemperaturaAlimentoDistribuicaoProdutoService;
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaTemperaturaAlimentoDistribuicaoProdutoService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
