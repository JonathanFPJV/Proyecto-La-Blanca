<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_boleta',
        'fecha_emision',
        'detalles'
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_boleta');
    }
}

