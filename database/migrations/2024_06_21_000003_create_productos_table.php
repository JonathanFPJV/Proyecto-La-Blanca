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
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('Id_Producto');
            $table->string('Codigo_producto', 45);
            $table->string('Nombre_producto', 45);
            $table->string('Descripcion', 255);
            $table->double('Precio');
            $table->string('Talla', 45);
            $table->string('Color', 45);
            $table->unsignedBigInteger('id_categoria')->nullable();
            $table->string('imagen', 255)->nullable();
            $table->double('precio_descuento')->nullable();
            $table->double('descuento')->nullable();
            $table->string('image_1', 255)->nullable();
            $table->string('image_2', 255)->nullable();
            $table->string('image_3', 255)->nullable();
            $table->string('image_4', 255)->nullable();
            $table->timestamps();
    
            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('productos');
    }
    
};
