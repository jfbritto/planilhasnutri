<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaTemperaturaAlimentoDistribuicao extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'data',
        'periodo',
        'id_parameter_evento',
        'id_parameter_responsavel',
        'acao_corretiva',
        'id_user',
        'status'
    ];
}
