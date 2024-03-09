<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaTemperaturaEquipamentoAreaClimatizadaConfig extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_unit',
        'id_parameter_equipamento',
        'maior_que',
        'menor_que',
        'obrigatorio',
        'id_user',
        'status'
    ];
}
