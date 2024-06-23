<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_comentario';

    protected $fillable = [
        'Puntuacion', 
        'Fecha', 
        'Comentario', 
        'ID_Usuario', 
        'Id_Producto', 
        'fecha_modificacion', 
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'Id_Producto');
    }
}
