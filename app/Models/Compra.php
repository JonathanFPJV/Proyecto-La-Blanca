<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $primaryKey = 'idCompras';

    protected $fillable = [
        'id_orden', 
        'id_pedido', 
        'id_envio', 
        'Estado', 
        'Monto', 
        'Fecha',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }

    public function envio()
    {
        return $this->belongsTo(Envio::class, 'id_envio');
    }
}
