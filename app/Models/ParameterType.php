<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParameterType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_unit',
        'name',
        'status'
    ];
}
