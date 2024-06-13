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
        Schema::table('logisticas', function (Blueprint $table) {
            $table->dropColumn('Fecha'); // Primero, eliminamos la columna existente
            $table->timestamp('Fecha')->default(DB::raw('CURRENT_TIMESTAMP'))->change(); // Luego, la volvemos a crear con la configuración deseada
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logisticas', function (Blueprint $table) {
            $table->date('Fecha')->nullable()->change(); // Revertimos el cambio en caso de rollback
        });
    }
};

