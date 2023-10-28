<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaTemperaturaAlimentoBanhoMaria extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'data',
        'periodo',
        'id_parameter_produto',
        'primeira_hora',
        'primeira_temperatura',
        'segunda_hora',
        'segunda_temperatura',
        'acao_corretiva',
        'id_user',
        'status'
    ];
}
