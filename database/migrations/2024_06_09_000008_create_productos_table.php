<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('Id_Producto');
            $table->string('Codigo_producto', 45);
            $table->string('Nombre_producto', 45);
            $table->string('Descripcion', 255);
            $table->float('Precio');
            $table->string('Categoria', 45);
            $table->string('Talla', 45);
            $table->string('Color', 45);
            $table->string('imagen', 255)->nullable();
            $table->double('precio_descuento')->nullable();
            $table->double('descuento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
