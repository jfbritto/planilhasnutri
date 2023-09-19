<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaGrupoAmostraPrato extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'data',
        'nome_grupo',
        'numero_pessoas',
        'cardapio',
        'id_user',
        'status',
    ];
}
