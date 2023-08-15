<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaSaturacaoOleoGordura extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'data',
        'id_parameter_area',
        'id_parameter_equipamento',
        'hora_primeira_afericao',
        'temperatura_primeira_afericao',
        'hora_segunda_afericao',
        'temperatura_segunda_afericao',
        'acao_corretiva',
        'id_parameter_responsavel_acao',
        'leitura_fita',
        'id_parameter_situacao_gordura',
        'id_parameter_responsavel',
        'id_user',
        'status'
    ];
}
