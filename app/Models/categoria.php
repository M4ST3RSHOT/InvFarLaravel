<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'imagen',
    ];
    public function scopeProductos($query,$id){
        return $query
                    ->join('productos','categorias.id','productos.categoria_id')
                    ->select('categorias.nombre','productos.*')
                    ->where('categorias.id',$id)
                    ->get();
    }
    //CONSEJO, trata las tablas con el nombre con el cual esta en el MYSQL es decir => productos, categorias, adquieres etc, siempre con la s
}
