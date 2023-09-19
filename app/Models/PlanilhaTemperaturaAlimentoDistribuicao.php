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
        'id_parameter_produto',
        'id_parameter_evento',
        'id_parameter_responsavel',
        'hora_1',
        'tremperatura_1',
        'hora_2',
        'tremperatura_2',
        'hora_3',
        'tremperatura_3',
        'hora_4',
        'tremperatura_4',
        'hora_5',
        'tremperatura_5',
        'hora_6',
        'tremperatura_6',
        'hora_7',
        'tremperatura_7',
        'acao_corretiva',
        'id_user',
        'status'
    ];
}
