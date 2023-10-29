<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaAvaliacaoManejoResiduo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_planilha',
        'data',
        'lixeira_apropriada',
        'retirada_conforme',
        'manipuladores_treinados',
        'area_externa_apropriada',
        'residuos_organicos_retirados',
        'area_externa_higienizada',
        'observacoes',
        'id_user',
        'status'
    ];
}
