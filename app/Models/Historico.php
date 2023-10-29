<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'data',
        'id_user',
        'id_unit',
        'id_planilha',
        'id_planilha_registro',
        'acao',
        'status',
    ];
}
