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
        Schema::create('cuenta_bancarias', function (Blueprint $table) {
            $table->id('id_cuenta');
            $table->string('Tipo_cuenta', 50);
            $table->string('Nombre_banco', 255)->nullable();
            $table->string('Num_cuenta', 50)->nullable();
            $table->string('paypal_email', 255)->nullable();
            $table->foreignId('ID_Usuario')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuenta_bancarias');
    }
};
