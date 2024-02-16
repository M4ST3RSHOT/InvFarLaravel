<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cliente extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'apellido',
        'fecha_nacimiento',
        'ci',
        'correo',
        'telefono',
        'imagen',
    ];
}
