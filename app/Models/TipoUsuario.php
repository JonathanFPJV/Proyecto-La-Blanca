<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    use HasFactory;

    protected $table = 'tipo_usuarios';
    protected $primaryKey = 'ID_tipo';

    protected $fillable = ['Nombre_tipo'];

    public function users()
    {
        return $this->hasMany(User::class, 'ID_Tipo');
    }
}

