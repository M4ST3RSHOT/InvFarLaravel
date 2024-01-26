<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class personal extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'apellido',
        'password',
        'tipo',
        'fecha_inicio',
        'ci',
        'correo',
        'direccion',
        'telefono',
        'salario',
        'farmacia_id'
    ];
}
