<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'n_pedido', 
        'Estado', 
        'Fecha_pedido', 
        'Monto_total', 
        'metodo_pago', 
        'id_boleta',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }

    public function boleta()
    {
        return $this->belongsTo(Boleta::class, 'id_boleta');
    }

    public function logistica()
    {
        return $this->hasMany(Logistica::class, 'n_pedido');
    }
}
