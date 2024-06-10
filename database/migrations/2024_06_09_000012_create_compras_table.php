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
        Schema::create('compras', function (Blueprint $table) {
            $table->id('idCompras');
            $table->string('id_orden', 50)->unique();
            $table->string('id_pedido', 45)->nullable();
            $table->foreign('id_pedido')->references('n_pedido')->on('pedidos')->onDelete('cascade');
            $table->string('id_envio', 45)->nullable();
            $table->foreign('id_envio')->references('n_envio')->on('envios')->onDelete('cascade');
            $table->string('Estado', 45);
            $table->double('Monto');
            $table->date('Fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
