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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->bigIncrements('id_comentario');
            $table->integer('Puntuacion');
            $table->date('Fecha');
            $table->text('Comentario');
            $table->unsignedBigInteger('ID_Usuario');
            $table->unsignedBigInteger('Id_Producto');
            $table->date('fecha_modificacion')->nullable();
            $table->string('estado', 45);
            $table->timestamps();
    
            $table->foreign('ID_Usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('Id_Producto')->references('Id_Producto')->on('productos')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('comentarios');
    }
    
};
