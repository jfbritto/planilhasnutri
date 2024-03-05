<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaRastreabilidadeDiaria extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_parameter_produto',
        'data',
        'lote',
        'validade',
        'id_parameter_fabricante',
        'image',
        'id_user',
        'status'
    ];
}
