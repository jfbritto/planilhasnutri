<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaRegistroCongelamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'data_congelamento',
        'id_parameter_produto',
        'quantidade',
        'data_recebimento',
        'data_fabricacao',
        'id_parameter_alergeno',
        'id_user',
        'status'
    ];
}
