<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaLimpezaCaixaGordura extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_parameter_caixa_gordura',
        'id_parameter_area',
        'id_parameter_responsavel',
        'data_limpeza',
        'data_proxima_limpeza',
        'id_user',
        'status'
    ];
}
