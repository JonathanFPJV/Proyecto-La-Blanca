<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'Id_Producto'; // Especifica la clave primaria

    protected $fillable = [
        'Codigo_producto', 
        'Nombre_producto', 
        'Descripcion', 
        'Precio', 
        'Talla', 
        'Color', 
        'id_categoria', 
        'imagen', 
        'precio_descuento', 
        'descuento',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'Id_Producto');
    }

    public function logistica()
    {
        return $this->hasMany(Logistica::class, 'Id_Producto');
    }

    public function historialPrecios()
    {
        return $this->hasMany(HistorialPrecio::class, 'id_producto');
    }
}
