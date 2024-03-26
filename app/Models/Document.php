<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'planilha_base',
        'id_planilha',
        'id_unit',
        'id_user',
        'file'
    ];
}
