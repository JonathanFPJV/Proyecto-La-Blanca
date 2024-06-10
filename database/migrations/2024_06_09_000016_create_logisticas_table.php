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
        Schema::create('logisticas', function (Blueprint $table) {
            $table->id('Id_Logistica');
            $table->foreignId('Id_usuario')->constrained('users');
            $table->foreignId('Id_Almacen');
            $table->foreign('Id_Almacen')->references('Id_Almacen')->on('almacenes');
            $table->foreignId('Id_Producto');
            $table->foreign('Id_Producto')->references('Id_Producto')->on('productos');
            $table->string('n_orden', 50);
            $table->foreign('n_orden')->references('id_orden')->on('compras');
            $table->integer('stock');
            $table->date('Fecha');
            $table->integer('Cantidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logisticas');
    }
};
