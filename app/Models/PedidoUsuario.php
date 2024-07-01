<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoUsuario extends Model
{
    
     // Indica que la vista no tiene timestamps (created_at y updated_at)
     public $timestamps = false;

     // Nombre de la tabla que representa la vista en la base de datos
     protected $table = 'pedidos_usuarios';
 
     // Si la vista no tiene una clave primaria, indica que no existe clave primaria
     protected $primaryKey = null;
     public $incrementing = false;
 
     // Atributos asignables en masa
     protected $fillable = [
         'id',
         'Nombre_Completo',
         'n_Pedido',
         'Fecha_pedido',
         'Monto_total',
         'Estado',
         'fecha_entrega',
         'EstadoEnvio',
     ];
}
