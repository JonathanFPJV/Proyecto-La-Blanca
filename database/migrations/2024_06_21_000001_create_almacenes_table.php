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
        Schema::create('almacenes', function (Blueprint $table) {
            $table->bigIncrements('Id_Almacen');
            $table->string('Nombre_almacen', 100);
            $table->string('Direccion_almacen', 100);
            $table->integer('Capacidad');
            $table->integer('capacidad_disponible')->nullable();
            $table->string('estado', 50);
            $table->string('tipo', 50);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('almacenes');
    }
    
};
