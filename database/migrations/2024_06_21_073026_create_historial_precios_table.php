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
        Schema::create('historial_precios', function (Blueprint $table) {
            $table->bigIncrements('id_historial');
            $table->unsignedBigInteger('id_producto');
            $table->double('precio_anterior');
            $table->double('precio_nuevo')->nullable();
            $table->date('fecha_modificacion');
            $table->timestamps();
    
            $table->foreign('id_producto')->references('Id_Producto')->on('productos')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('historial_precios');
    }
    
};
