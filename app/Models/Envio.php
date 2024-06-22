<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    use HasFactory;

    protected $fillable = [
        'n_envio', 
        'Monto', 
        'Fecha_ENTREGA', 
        'Direccion_entrega', 
        'Estado',
    ];

    public function compras()
    {
        return $this->hasMany(Compra::class, 'id_envio');
    }
}
