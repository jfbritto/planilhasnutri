<?php

namespace App\Http\Controllers\Planilhas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PlanilhaTemperaturaEquipamentoAreaClimatizadaConfigService;
use App\Services\PlanilhaTemperaturaEquipamentoAreaClimatizadaService;
use PDF;

class PlanilhaTemperaturaEquipamentoAreaClimatizadaConfigController extends Controller
{
    private $planilhaTemperaturaEquipamentoAreaClimatizadaConfigService;
    private $planilhaTemperaturaEquipamentoAreaClimatizadaService;

    public function __construct(
        PlanilhaTemperaturaEquipamentoAreaClimatizadaConfigService $planilhaTemperaturaEquipamentoAreaClimatizadaConfigService,
        PlanilhaTemperaturaEquipamentoAreaClimatizadaService $planilhaTemperaturaEquipamentoAreaClimatizadaService
    ) {
        $this->planilhaTemperaturaEquipamentoAreaClimatizadaConfigService = $planilhaTemperaturaEquipamentoAreaClimatizadaConfigService;
        $this->planilhaTemperaturaEquipamentoAreaClimatizadaService = $planilhaTemperaturaEquipamentoAreaClimatizadaService;
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => auth()->user()->id,
            'id_unit' => auth()->user()->id_unit,
            'id_parameter_equipamento' => $request->id_parameter_equipamento,
            'maior_que' => $request->maior_que,
            'menor_que' => $request->menor_que,
            'obrigatorio' => $request->obrigatorio
        ];

        $equipamentos = $this->planilhaTemperaturaEquipamentoAreaClimatizadaConfigService->list(['id_parameter_equipamento_filter' => $request->id_parameter_equipamento]);
        foreach ($equipamentos['data'] as $equipamento) {
            $data2 = [
                'id' => $equipamento->id,
                'status' => 'D'
            ];

            $this->planilhaTemperaturaEquipamentoAreaClimatizadaConfigService->destroy($data2);
        }

        $response = $this->planilhaTemperaturaEquipamentoAreaClimatizadaConfigService->store($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 201);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function update(Request $request)
    {
        $formData = $request->all();
        $response = $this->planilhaTemperaturaEquipamentoAreaClimatizadaConfigService->update($formData);

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

        $response = $this->planilhaTemperaturaEquipamentoAreaClimatizadaConfigService->destroy($data);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success'], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function list(Request $request)
    {
        $filter = $request->all();
        $response = $this->planilhaTemperaturaEquipamentoAreaClimatizadaConfigService->list($filter);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }

    public function obrigatoriosNaoPreenchidos(Request $request)
    {
        $filter = $request->all();

        $idsObrigatorios = [];
        $nomesEquipamentos = [];
        $equipamentosConfig = $this->planilhaTemperaturaEquipamentoAreaClimatizadaConfigService->list($filter);
        foreach ($equipamentosConfig['data'] as $equipamentoConfig) {
            if ($equipamentoConfig->obrigatorio) {
                $idsObrigatorios[] = $equipamentoConfig->id_parameter_equipamento;
                $nomesEquipamentos[$equipamentoConfig->id_parameter_equipamento] = $equipamentoConfig->equipamento;
            }
        }

        $idsCadastradosHoje = [];
        $equipamentosCadastradosHoje = $this->planilhaTemperaturaEquipamentoAreaClimatizadaService->list(['data_ini_filter' => date("Y-m-d"), 'data_fim_filter' => date("Y-m-d")]);
        foreach ($equipamentosCadastradosHoje['data'] as $equipamentoCadastradosHoje) {
            $idsCadastradosHoje[] = $equipamentoCadastradosHoje->id_parameter_equipamento;
        }

        $idsFaltantes = array_diff($idsObrigatorios, $idsCadastradosHoje);

        $equipamentos = [];
        foreach ($idsFaltantes as $idFaltante) {
            $equipamentos[] = $nomesEquipamentos[$idFaltante];
        }

        $data['status'] = 'success';

        if (!empty($equipamentos)) {
            $data['data'] = implode(", ", $equipamentos);
        }

        return response()->json(['status'=>'success', 'data'=>$data], 200);
    }

    public function find()
    {
        $id = $_GET['id_parameter_type'];
        $response = $this->planilhaTemperaturaEquipamentoAreaClimatizadaConfigService->find($id);

        if($response['status'] == 'success')
            return response()->json(['status'=>'success', 'data'=>$response['data']], 200);

        return response()->json(['status'=>'error', 'message'=>$response['data']], 400);
    }
}
