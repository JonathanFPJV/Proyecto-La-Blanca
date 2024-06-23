<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'Id_Almacen';
    protected $fillable = [
        'Nombre_almacen', 
        'Direccion_almacen', 
        'Capacidad', 
        'capacidad_disponible', 
        'estado', 
        'tipo',
    ];

    public function logistica()
    {
        return $this->hasMany(Logistica::class, 'Id_Almacen');
    }
}
