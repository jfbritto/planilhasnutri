<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ServicoService;
use App\Services\DocumentService;
use Illuminate\Support\Facades\Storage;

class ServicoController extends Controller
{
    private $servicoService;
    private $documentService;

    public function __construct(ServicoService $servicoService, DocumentService $documentService)
    {
        $this->servicoService = $servicoService;
        $this->documentService = $documentService;
    }

    public function index()
    {
        return view('servico.home');
    }

    public function store(Request $request)
    {

        $data = [
            'id_user' => auth()->user()->id,
            'id_parameter_servico' => $request->id_parameter_servico,
            'data' => $request->data,
            'proxima_data' => $request->proxima_data,
            'frequencia_meses' => $request->frequencia_meses,
            'observacoes' => $request->observacoes
        ];

        $response = $this->servicoService->store($data);

        if ($response['status'] == 'success') {
            $documento = $request->file('documento');
            if (!empty($documento)) {
                $this->documentService->uploadDocumento(
                    $documento,
                    20,
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
        $formData = $request->all();
        $response = $this->servicoService->update($formData);

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

        $servico = $this->servicoService->find($request->id);

        $response = $this->servicoService->destroy($data);

        if ($response['status'] == 'success') {
            if ($servico['status'] == 'success') {

                $documentos = $this->documentService->find(20, auth()->user()->id_unit, $servico['data'][0]->id);

                foreach ($documentos['data'] as $key => $documento) {
                    $this->documentService->destroy($documento->id);
                }

            }

            return response()->json(['status'=>'success'], 200);
        }

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function conclude(Request $request)
    {
        $data = [
            'id' => trim($request->id),
            'status' => 'C'
        ];

        $response = $this->servicoService->update($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();
        $response = $this->servicoService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
