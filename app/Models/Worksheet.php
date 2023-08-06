<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worksheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_user',
        'id_unit',
        'id_worksheet_structure',
        'description',
        'status'
    ];
}
