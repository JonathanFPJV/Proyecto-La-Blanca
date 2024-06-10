<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'apellido',
        'nombreusuario',
        'direccion',
        'avatar',
        'avatar_original',
        'token',
        'telefono',
        'estado',
        'ID_Tipo',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tipoUsuario()
    {
        return $this->belongsTo(TipoUsuario::class, 'ID_Tipo');
    }

    public function cuentaBancaria()
    {
        return $this->hasMany(CuentaBancaria::class, 'ID_Usuario');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'ID_Usuario');
    }

    public function logistica()
    {
        return $this->hasMany(Logistica::class, 'Id_usuario');
    }

}
