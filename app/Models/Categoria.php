<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_categoria'];

    /**
     * Get the products for the category.
     */
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria');
    }
}
