<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'n_pedido', 'Estado', 'Fecha_pedido', 'Monto_total', 'metodo_pago', 'id_boleta'
    ];

    public function compras()
    {
        return $this->hasMany(Compra::class, 'id_pedido', 'n_pedido');
    }

    public function boleta()
    {
        return $this->belongsTo(Boleta::class, 'id_boleta');
    }
}
