<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaManutencaoCalibracaoEquipamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_parameter_equipamento',
        'calibracao_foi_feita',
        'data_calibracao',
        'equipamento_com_problema',
        'qual_problema',
        'providencias_tomadas',
        'problema_foi_solucionado',
        'observacoes',
        'id_user',
        'status'
    ];
}
