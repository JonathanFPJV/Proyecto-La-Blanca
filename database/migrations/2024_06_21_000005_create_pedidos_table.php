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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('n_pedido', 45);
            $table->string('Estado', 45);
            $table->date('Fecha_pedido');
            $table->double('Monto_total');
            $table->string('metodo_pago', 45);
            $table->unsignedBigInteger('id_boleta')->nullable();
            $table->timestamps();
    
            $table->unique('n_pedido');
            $table->foreign('id_boleta')->references('id')->on('boletas')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
    
};
