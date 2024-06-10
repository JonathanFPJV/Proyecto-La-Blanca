<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $primaryKey = 'n_pedido';
    public $incrementing = false; // Indica que la clave primaria no es auto-incremental
    protected $keyType = 'string'; // Indica que la clave primaria es de tipo string

    protected $fillable = [
        'n_pedido', 'Estado', 'Fecha_pedido', 'Monto_total', 'metodo_pago'
    ];

    public function compras()
    {
        return $this->hasMany(Compra::class, 'id_pedido', 'n_pedido');
    }
}
