<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'unidad',
        'peso',
        'categoria_id',
        'precio_compra',
        'precio_venta',
        'imagen',
        'stock',
        'stockdeseado',
    ];

    // public function scopelistar_nombres($query,$id){
    //     return $query
    //                 ->select('productos.*')
    //                 ->get();
    // }
}
