<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaRastreabilidadeDiariaService;
use App\Services\DocumentService;
use PDF;
use Illuminate\Support\Facades\Storage;

class PlanilhaRastreabilidadeDiariaController extends Controller
{
    private $planilhaRastreabilidadeDiariaService;
    private $documentService;
    private $idPlanilha = 19;

    public function __construct(PlanilhaRastreabilidadeDiariaService $planilhaRastreabilidadeDiariaService, DocumentService $documentService) {
        $this->planilhaRastreabilidadeDiariaService = $planilhaRastreabilidadeDiariaService;
        $this->documentService = $documentService;
    }

    public function index()
    {
        return view('planilha.rastreabilidade_diaria');
    }

    public function store(Request $request)
    {

        $data = [
            'id_user' => auth()->user()->id,
            'id_parameter_produto' => $request->id_parameter_produto,
            'data' => $request->data,
            'lote' => $request->lote,
            'validade' => $request->validade,
            'id_parameter_fabricante' => $request->id_parameter_fabricante
        ];

        $response = $this->planilhaRastreabilidadeDiariaService->store($data);

        if ($response['status'] == 'success') {
            $documento = $request->file('image');
            if (!empty($documento)) {
                $this->documentService->uploadDocumento(
                    $documento,
                    19,
                    $response["data"]->id
                );
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
            'id_parameter_produto' => $request->id_parameter_produto,
            'data' => $request->data,
            'lote' => $request->lote,
            'validade' => $request->validade,
            'id_parameter_fabricante' => $request->id_parameter_fabricante
        ];

        $response = $this->planilhaRastreabilidadeDiariaService->update($data);

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

        $planilha = $this->planilhaRastreabilidadeDiariaService->find($request->id);

        $response = $this->planilhaRastreabilidadeDiariaService->destroy($data);

        if ($response['status'] == 'success') {
            if ($planilha['status'] == 'success') {

                $documentos = $this->documentService->find(19, auth()->user()->id_unit, $planilha['data'][0]->id);

                foreach ($documentos['data'] as $key => $documento) {
                    $this->documentService->destroy($documento->id);
                }

            }

            return response()->json(['status'=>'success'], 200);
        }

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();

        $response = $this->planilhaRastreabilidadeDiariaService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaRastreabilidadeDiariaService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function gerarPDF(Request $request)
    {
        $filter = $request->all();

        $itens = $this->planilhaRastreabilidadeDiariaService->list($filter)['data'];

        $titulo = "Rastreabilidade Diária";

        // Gere o PDF com a orientação do papel configurada como paisagem
        $pdf = PDF::loadView('pdf.rastreabilidade_diaria', ['itens' => $itens, 'titulo' => $titulo]);
        $pdf->setPaper('A4', 'landscape'); // Configuração de orientação paisagem

        return $pdf->stream('rastreabilidade_diaria.pdf');
    }
}
