<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaRegistroNaoConformidadeDetectadaAutoAvaliacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'data',
        'nao_conformidade',
        'possiveis_causas',
        'tratamento_produto',
        'acoes_corretivas',
        'id_parameter_responsavel',
        'id_user',
        'status'
    ];
}
