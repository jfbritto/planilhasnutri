<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaTemperaturaAlimentoDistribuicaoProduto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_planilha_distribuicao',
        'id_parameter_produto',
        'hora_1',
        'temperatura_1',
        'hora_2',
        'temperatura_2',
        'hora_3',
        'temperatura_3',
        'hora_4',
        'temperatura_4',
        'hora_5',
        'temperatura_5',
        'hora_6',
        'temperatura_6',
        'hora_7',
        'temperatura_7',
        'id_user',
        'status'
    ];
}
