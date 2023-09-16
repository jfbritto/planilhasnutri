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
        'primeira_tremperatura',
        'segunda_hora',
        'segunda_tremperatura',
        'acao_corretiva',
        'id_user',
        'status'
    ];
}
