<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaVerificacaoProcedimentoHigienizacaoHortifruti extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'data',
        'id_parameter_alimento',
        'hora_imersao_inicio',
        'hora_imersao_fim',
        'concentracao_solucao_clorada',
        'acao_corretiva',
        'id_parameter_responsavel',
        'id_user',
        'status'
    ];
}
