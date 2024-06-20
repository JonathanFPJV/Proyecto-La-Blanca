<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialPreciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_precios', function (Blueprint $table) {
            $table->id('id_historial');
            $table->unsignedBigInteger('id_producto');
            $table->float('precio_anterior');
            $table->float('precio_nuevo')->nullable();
            $table->date('fecha_modificacion');
            $table->timestamps();

            $table->foreign('id_producto')->references('Id_Producto')->on('productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_precios');
    }
}
