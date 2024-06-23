<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logistica extends Model
{
    use HasFactory;

    protected $primaryKey = 'Id_Logistica';

    protected $fillable = [
        'Id_usuario', 
        'Id_Almacen', 
        'Id_Producto', 
        'n_orden', 
        'stock', 
        'Cantidad',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'Id_usuario');
    }

    public function almacen()
    {
        return $this->belongsTo(Almacen::class, 'Id_Almacen');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'Id_Producto');
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'n_orden');
    }
}
