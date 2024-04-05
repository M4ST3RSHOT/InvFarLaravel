<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lote extends Model
{
    use HasFactory;
    protected $fillable=[
        'stock',
        'fecha_expiracion',
        'adquiere_id',
        'producto_id',
    ];
}
