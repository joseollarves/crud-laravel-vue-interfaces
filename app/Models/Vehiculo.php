<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca',
        'modelo',
        'placa',
        'color',
        'tipo',
        'estado',
        'foto_primera',
        'foto_segunda',
        'foto_tercera,'
    ];
}
