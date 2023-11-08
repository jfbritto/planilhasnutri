<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_parameter_servico',
        'data',
        'proxima_data',
        'frequencia_meses',
        'documento',
        'id_user',
        'status',
    ];
}
