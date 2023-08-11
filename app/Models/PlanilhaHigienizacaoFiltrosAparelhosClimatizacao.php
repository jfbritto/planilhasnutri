<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaHigienizacaoFiltrosAparelhosClimatizacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_user',
        'id_parameter_area',
        'id_parameter_equipamento',
        'id_parameter_responsavel',
        'data_higienizacao',
        'data_proxima_higienizacao',
        'status'
    ];
}
