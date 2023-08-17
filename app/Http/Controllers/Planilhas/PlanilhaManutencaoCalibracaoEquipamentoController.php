<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaManutencaoCalibracaoEquipamentoService;

class PlanilhaManutencaoCalibracaoEquipamentoController extends Controller
{
    private $PlanilhaManutencaoCalibracaoEquipamentoService;

    public function __construct(PlanilhaManutencaoCalibracaoEquipamentoService $PlanilhaManutencaoCalibracaoEquipamentoService)
    {
        $this->PlanilhaManutencaoCalibracaoEquipamentoService = $PlanilhaManutencaoCalibracaoEquipamentoService;
    }

    public function index()
    {
        return view('planilha.manutencao_calibracao_equipamento');
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'id_parameter_equipamento' => $request->id_parameter_equipamento,
            'calibracao_foi_feita' => $request->calibracao_foi_feita,
            'data_calibracao' => $request->data_calibracao,
            'equipamento_com_problema' => $request->equipamento_com_problema,
            'qual_problema' => $request->qual_problema,
            'providencias_tomadas' => $request->providencias_tomadas,
            'problema_foi_solucionado' => $request->problema_foi_solucionado,
            'observacoes' => $request->observacoes
        ];

        $response = $this->PlanilhaManutencaoCalibracaoEquipamentoService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {
        $data = [
            'id' => $request->id,
            'id_parameter_equipamento' => $request->id_parameter_equipamento,
            'calibracao_foi_feita' => $request->calibracao_foi_feita,
            'data_calibracao' => $request->data_calibracao,
            'equipamento_com_problema' => $request->equipamento_com_problema,
            'qual_problema' => $request->qual_problema,
            'providencias_tomadas' => $request->providencias_tomadas,
            'problema_foi_solucionado' => $request->problema_foi_solucionado,
            'observacoes' => $request->observacoes
        ];

        $response = $this->PlanilhaManutencaoCalibracaoEquipamentoService->update($data);

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

        $response = $this->PlanilhaManutencaoCalibracaoEquipamentoService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list()
    {
        $response = $this->PlanilhaManutencaoCalibracaoEquipamentoService->list();

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->PlanilhaManutencaoCalibracaoEquipamentoService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
