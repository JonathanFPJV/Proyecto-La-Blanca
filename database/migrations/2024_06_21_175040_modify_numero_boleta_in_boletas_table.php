<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNumeroBoletaInBoletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('boletas', function (Blueprint $table) {
            // Modificar el campo numero_boleta para que sea nullable
            $table->string('numero_boleta', 45)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boletas', function (Blueprint $table) {
            // Revertir el cambio, haciendo que numero_boleta no sea nullable
            $table->string('numero_boleta', 50)->nullable(false)->change();
        });
    }
}

