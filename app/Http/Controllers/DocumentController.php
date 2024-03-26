<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DocumentService;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    private $documentService;

    public function __construct(DocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function store(Request $request)
    {

        $fileName = '';
        $documento = $request->file('documento');
        if (!empty($documento)) {
            $fileName = $this->documentService->uploadDocumento(
                $documento,
                $request->planilha_base,
                $request->id_planilha
            );
        }

        if($fileName != '')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>''], 400);
    }

    public function destroy(Request $request)
    {
        if (isset($request->id_especifico)) {
            $documentos = $this->documentService->findUnique($request->id_especifico);
        } else {
            $documentos = $this->documentService->find($request->planilha_base, auth()->user()->id_unit, $request->id);
        }

        foreach ($documentos['data'] as $key => $documento) {
            $this->documentService->destroy($documento->id);
        }

        if($documentos['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$documentos['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$documentos['data']], 400);
    }

    public function find()
    {
        $planilha_base = $_GET['planilha_base'];
        $id_unit = $_GET['id_unit'];
        $id = $_GET['id'];
        $response = $this->documentService->find($planilha_base, $id_unit, $id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list()
    {
        $planilha_base = $_GET['planilha_base'];
        $id = $_GET['id'];

        $response = $this->documentService->list($planilha_base, $id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function downloadArquivo($fileName)
    {
        $return = $this->documentService->downloadArquivo($fileName);

        // Retorna uma resposta de download
        return response()->download($return[0], $return[1], $return[2]);
    }
}
