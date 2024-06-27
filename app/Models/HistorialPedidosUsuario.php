<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialPedidosUsuario extends Model
{
    // Desactivar timestamps  la vista no tiene campos created_at y updated_at
    public $timestamps = false;

    // tabla asociada es una vista
    protected $table = 'historial_pedidos_usuarios';

    // Si la vista no tiene una clave primaria, indica que no existe clave primaria
    protected $primaryKey = null;
    public $incrementing = false;

    // Si necesitas definir la clave primaria y es una combinación de campos
    // protected $primaryKey = ['ID', 'numero_Pedido'];
}
