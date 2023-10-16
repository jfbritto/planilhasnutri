<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaRegistroLimpeza extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'data',
        'id_parameter_responsavel',
        'id_parameter_area',
        'superficie_limpa',
        'frequencia',
        'conforme_naoconforme',
        'comentarios',
        'id_user',
        'status'
    ];
}
