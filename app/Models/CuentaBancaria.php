<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaBancaria extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_cuenta';

    protected $fillable = [
        'Tipo_cuenta', 
        'Nombre_banco', 
        'Num_cuenta', 
        'paypal_email', 
        'ID_Usuario',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario');
    }
}
