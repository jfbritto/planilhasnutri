<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaTemperaturaAlimentoDistribuicaoService;
use App\Services\PlanilhaTemperaturaAlimentoDistribuicaoProdutoService;
use PDF;

class PlanilhaTemperaturaAlimentoDistribuicaoController extends Controller
{
    private $planilhaTemperaturaAlimentoDistribuicaoService;
    private $planilhaTemperaturaAlimentoDistribuicaoProdutoService;

    public function __construct(
        PlanilhaTemperaturaAlimentoDistribuicaoService $planilhaTemperaturaAlimentoDistribuicaoService,
        PlanilhaTemperaturaAlimentoDistribuicaoProdutoService $planilhaTemperaturaAlimentoDistribuicaoProdutoService
    )
    {
        $this->planilhaTemperaturaAlimentoDistribuicaoService = $planilhaTemperaturaAlimentoDistribuicaoService;
        $this->planilhaTemperaturaAlimentoDistribuicaoProdutoService = $planilhaTemperaturaAlimentoDistribuicaoProdutoService;
    }

    public function index()
    {
        return view('planilha.temperatura_alimento_distribuicao');
    }

    public function store(Request $request)
    {

        $data = [
            'id_user' => auth()->user()->id,
            'data' => $request->data,
            'periodo' => $request->periodo,
            'id_parameter_evento' => $request->id_parameter_evento,
            'id_parameter_responsavel' => $request->id_parameter_responsavel,
            'acao_corretiva' => $request->acao_corretiva
        ];

        $response = $this->planilhaTemperaturaAlimentoDistribuicaoService->store($data);
        $id_planilha = $response["data"]->id;

        if (!empty($request->itens_planilha)) {
            $itensPlanilha = $request->itens_planilha;
            foreach ($itensPlanilha as $key => $value) {
                $data2 = [
                    'id_user' => auth()->user()->id,
                    'id_planilha_distribuicao' => $id_planilha,
                    'id_parameter_produto' => $value['id_parameter_produto'],
                    'hora_1' => $value['hora_1'],
                    'tremperatura_1' => $value['tremperatura_1'],
                    'hora_2' => $value['hora_2'],
                    'tremperatura_2' => $value['tremperatura_2']
                ];

                $response = $this->planilhaTemperaturaAlimentoDistribuicaoProdutoService->store($data2);
            }
        }

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {

        $data = [
            'id' => $request->id,
            'data' => $request->data,
            'periodo' => $request->periodo,
            'id_parameter_evento' => $request->id_parameter_evento,
            'id_parameter_responsavel' => $request->id_parameter_responsavel,
            'acao_corretiva' => $request->acao_corretiva
        ];

        $response = $this->planilhaTemperaturaAlimentoDistribuicaoService->update($data);
        $id_planilha = $request->id;

        if (!empty($request->itens_planilha)) {

            $this->planilhaTemperaturaAlimentoDistribuicaoProdutoService->destroy($id_planilha);

            $itensPlanilha = $request->itens_planilha;
            foreach ($itensPlanilha as $key => $value) {
                $data2 = [
                    'id_user' => auth()->user()->id,
                    'id_planilha_distribuicao' => $id_planilha,
                    'id_parameter_produto' => $value['id_parameter_produto'],
                    'hora_1' => $value['hora_1'],
                    'tremperatura_1' => $value['tremperatura_1'],
                    'hora_2' => $value['hora_2'],
                    'tremperatura_2' => $value['tremperatura_2']
                ];

                $response = $this->planilhaTemperaturaAlimentoDistribuicaoProdutoService->store($data2);
            }
        }

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

        $response = $this->planilhaTemperaturaAlimentoDistribuicaoService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaTemperaturaAlimentoDistribuicaoService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaTemperaturaAlimentoDistribuicaoService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaTemperaturaAlimentoDistribuicaoService->list($filter)['data'];

        $titulo = "Controle de Temperatura dos Alimentos na Distribuição";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.temperatura_alimento_distribuicao', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('temperatura_alimento_distribuicao.pdf');
    }
}
