<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    use HasFactory;

    protected $primaryKey = 'n_envio';
    public $incrementing = false; // Indica que la clave primaria no es auto-incremental
    protected $keyType = 'string'; // Indica que la clave primaria es de tipo string

    protected $fillable = [
        'n_envio', 'Monto', 'Fecha_ENTREGA', 'Direccion_entrega', 'Estado'
    ];

    public function compras()
    {
        return $this->hasMany(Compra::class, 'id_envio', 'n_envio');
    }
}
