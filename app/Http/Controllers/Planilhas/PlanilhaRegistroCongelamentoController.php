<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaRegistroCongelamentoService;
use PDF;

class PlanilhaRegistroCongelamentoController extends Controller
{
    private $planilhaRegistroCongelamentoService;

    public function __construct(PlanilhaRegistroCongelamentoService $planilhaRegistroCongelamentoService)
    {
        $this->planilhaRegistroCongelamentoService = $planilhaRegistroCongelamentoService;
    }

    public function index()
    {
        return view('planilha.registro_congelamento');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'data_congelamento' => $request->data_congelamento,
            'id_parameter_produto' => $request->id_parameter_produto,
            'quantidade' => $request->quantidade,
            'data_recebimento' => $request->data_recebimento,
            'data_fabricacao' => $request->data_fabricacao,
            'alergeno' => $request->alergeno
        ];

        $response = $this->planilhaRegistroCongelamentoService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {
        $data = [
            'id' => $request->id,
            'data_congelamento' => $request->data_congelamento,
            'id_parameter_produto' => $request->id_parameter_produto,
            'quantidade' => $request->quantidade,
            'data_recebimento' => $request->data_recebimento,
            'data_fabricacao' => $request->data_fabricacao,
            'alergeno' => $request->alergeno
        ];

        $response = $this->planilhaRegistroCongelamentoService->update($data);

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

        $response = $this->planilhaRegistroCongelamentoService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaRegistroCongelamentoService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaRegistroCongelamentoService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaRegistroCongelamentoService->list($filter)['data'];

        $titulo = "Registro de Congelamento";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.registro_congelamento', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('registro_congelamento.pdf');
    }
}
