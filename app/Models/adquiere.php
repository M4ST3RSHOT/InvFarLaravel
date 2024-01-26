<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adquiere extends Model
{
    use HasFactory;
    protected $fillable=[
        'proveedor_id',
        'fecha',
        'montototal',
        'personal_id',
    ];
}
