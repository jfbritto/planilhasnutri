<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaOcorrenciaPraga extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'data',
        'id_parameter_area',
        'id_parameter_praga',
        'observacoes',
        'id_user',
        'status'
    ];
}
