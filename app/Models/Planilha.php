<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilha extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_unit',
        'periodo',
        'id_parameter_produto',
        'id_user',
        'status',
    ];
}
