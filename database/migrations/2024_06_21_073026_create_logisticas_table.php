<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('logisticas', function (Blueprint $table) {
            $table->bigIncrements('Id_Logistica');
            $table->unsignedBigInteger('Id_usuario');
            $table->unsignedBigInteger('Id_Almacen');
            $table->unsignedBigInteger('Id_Producto');
            $table->string('n_orden', 50)->nullable();
            $table->integer('stock')->nullable();
            $table->integer('Cantidad')->default(1);
            $table->timestamps();
    
            $table->foreign('Id_usuario')->references('id')->on('users');
            $table->foreign('Id_Almacen')->references('Id_Almacen')->on('almacenes');
            $table->foreign('Id_Producto')->references('Id_Producto')->on('productos');
            $table->foreign('n_orden')->references('id_orden')->on('compras')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('logisticas');
    }
    
};
