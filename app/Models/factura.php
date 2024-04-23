<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class factura extends Model
{
    use HasFactory;
    protected $fillable=[
        'fecha',
        'subtotal',
        'descuento',
        'total',
        'personal_id',
        'user_id',
        'cliente_id',
    ];
    // public function scopeInfo_de_factura_de_venta($query,$id){
    //     return $query
    //                 ->join('personals','facturas.personal_id','personals.id')
    //                 ->join('clientes','facturas.user_id','clientes.id')
    //                 ->select('personals.id','personals.nombre','facturas.*')
    //                 ->where('facturas.id',$id)
    //                 ->get();
    // }
}
