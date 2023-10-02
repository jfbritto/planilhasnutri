<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaTemperaturaEquipamentoAreaClimatizada extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'data',
        'id_parameter_responsavel',
        'id_parameter_equipamento',
        'temperatura_1',
        'temperatura_2',
        'id_user',
        'status'
    ];
}
