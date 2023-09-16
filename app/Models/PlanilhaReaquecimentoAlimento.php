<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaReaquecimentoAlimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'data',
        'id_parameter_produto',
        'hora_temperatura_antes',
        'temperatura_antes',
        'hora_temperatura_depois',
        'temperatura_depois',
        'tempo_aquecimento',
        'conforme_naoconforme',
        'id_parameter_responsavel',
        'id_user',
        'status'
    ];
}
