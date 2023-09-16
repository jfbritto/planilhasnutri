<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaResfriamentoRapidoAlimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'data',
        'id_parameter_produto',
        'cozimento_hora_final',
        'cozimento_temperatura_interna',
        'resfriamento_hora_inicio',
        'resfriamento_temperatura_central_inicio',
        'resfriamento_hora_fim',
        'resfriamento_temperatura_central_fim',
        'conforme_naoconforme',
        'id_parameter_responsavel',
        'id_user',
        'status'
    ];
}
