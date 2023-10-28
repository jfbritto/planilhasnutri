<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaTemperaturaAlimentoDistribuicaoConfigService;

class PlanilhaTemperaturaAlimentoDistribuicaoConfigController extends Controller
{
    private $planilhaTemperaturaAlimentoDistribuicaoConfigService;

    public function __construct(PlanilhaTemperaturaAlimentoDistribuicaoConfigService $planilhaTemperaturaAlimentoDistribuicaoConfigService)
    {
        $this->planilhaTemperaturaAlimentoDistribuicaoConfigService = $planilhaTemperaturaAlimentoDistribuicaoConfigService;
    }

    public function store(Request $request)
    {

        if (!empty($request->ids_produtos)) {

            $this->planilhaTemperaturaAlimentoDistribuicaoConfigService->destroy($request->periodo_config);

            $idsProdutos = $request->ids_produtos;
            foreach ($idsProdutos as $key => $value) {

                $data = [
                    'id_unit' => auth()->user()->id_unit,
                    'id_user' => auth()->user()->id,
                    'periodo' => $request->periodo_config,
                    'id_parameter_produto' => $value
                ];

                $response = $this->planilhaTemperaturaAlimentoDistribuicaoConfigService->store($data);
            }
        }

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaTemperaturaAlimentoDistribuicaoConfigService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

}
