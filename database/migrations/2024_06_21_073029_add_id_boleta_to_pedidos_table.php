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
        Schema::table('pedidos', function (Blueprint $table) {
            if (!Schema::hasColumn('pedidos', 'id_boleta')) {
                $table->unsignedBigInteger('id_boleta')->nullable()->after('metodo_pago');
                $table->foreign('id_boleta')->references('id')->on('boletas')->onDelete('set null');
            }
        });
    }
    
    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            if (Schema::hasColumn('pedidos', 'id_boleta')) {
                $table->dropForeign(['id_boleta']);
                $table->dropColumn('id_boleta');
            }
        });
    }
    
    
};
