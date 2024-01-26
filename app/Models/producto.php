<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'descripcion',
        'unidad',
        'peso',
        'categoria_id',
        'precio_compra',
        'precio_venta',
    ];
}
