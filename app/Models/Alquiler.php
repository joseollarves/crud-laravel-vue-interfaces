<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente',
        'vehiculo',
        'fecha_desde',
        'fecha_hasta',
        'precio',
        'estado'
    ];

}
