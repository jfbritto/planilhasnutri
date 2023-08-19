<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaRecebimentoMateriaPrimaService;

class PlanilhaRecebimentoMateriaPrimaController extends Controller
{
    private $planilhaRecebimentoMateriaPrimaService;

    public function __construct(PlanilhaRecebimentoMateriaPrimaService $planilhaRecebimentoMateriaPrimaService)
    {
        $this->planilhaRecebimentoMateriaPrimaService = $planilhaRecebimentoMateriaPrimaService;
    }

    public function index()
    {
        return view('planilha.recebimento_materia_prima');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'id_parameter_produto' => $request->id_parameter_produto,
            'id_parameter_fornecedor' => $request->id_parameter_fornecedor,
            'ordem_de_compra' => $request->ordem_de_compra,
            'nota_fiscal' => $request->nota_fiscal,
            'sif_lote' => $request->sif_lote,
            'data_validade' => $request->data_validade,
            'temperatura_alimento' => $request->temperatura_alimento,
            'temperatura_veiculo' => $request->temperatura_veiculo,
            'nao_conformidade' => $request->nao_conformidade,
            'acao_corretiva' => $request->acao_corretiva,
            'id_parameter_responsavel' => $request->id_parameter_responsavel
        ];

        $response = $this->planilhaRecebimentoMateriaPrimaService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {
        $data = [
            'id' => $request->id,
            'data' => $request->data,
            'id_parameter_produto' => $request->id_parameter_produto,
            'id_parameter_fornecedor' => $request->id_parameter_fornecedor,
            'ordem_de_compra' => $request->ordem_de_compra,
            'nota_fiscal' => $request->nota_fiscal,
            'sif_lote' => $request->sif_lote,
            'data_validade' => $request->data_validade,
            'temperatura_alimento' => $request->temperatura_alimento,
            'temperatura_veiculo' => $request->temperatura_veiculo,
            'nao_conformidade' => $request->nao_conformidade,
            'acao_corretiva' => $request->acao_corretiva,
            'id_parameter_responsavel' => $request->id_parameter_responsavel
        ];

        $response = $this->planilhaRecebimentoMateriaPrimaService->update($data);

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

        $response = $this->planilhaRecebimentoMateriaPrimaService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list()
    {
        $response = $this->planilhaRecebimentoMateriaPrimaService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaRecebimentoMateriaPrimaService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
