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
        'cliente_id'
    ];
}
