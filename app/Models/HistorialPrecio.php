<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialPrecio extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_historial';

    protected $fillable = [
        'id_producto', 
        'precio_anterior', 
        'precio_nuevo', 
        'fecha_modificacion',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
