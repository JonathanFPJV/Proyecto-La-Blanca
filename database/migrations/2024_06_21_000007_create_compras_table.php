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
        Schema::create('compras', function (Blueprint $table) {
            $table->bigIncrements('idCompras');
            $table->string('id_orden', 50);
            $table->string('id_pedido', 45)->nullable();
            $table->string('id_envio', 45)->nullable();
            $table->string('Estado', 45);
            $table->double('Monto');
            $table->date('Fecha');
            $table->timestamps();
    
            $table->unique('id_orden');
            $table->foreign('id_pedido')->references('n_pedido')->on('pedidos')->onDelete('cascade');
            $table->foreign('id_envio')->references('n_envio')->on('envios')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('compras');
    }
    
};
