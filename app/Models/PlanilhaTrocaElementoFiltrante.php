<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaTrocaElementoFiltrante extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_planilha',
        'id_user',
        'id_parameter_area',
        'id_parameter_filtro',
        'id_parameter_responsavel',
        'data_troca',
        'data_proxima_troca',
        'status'
    ];
}
