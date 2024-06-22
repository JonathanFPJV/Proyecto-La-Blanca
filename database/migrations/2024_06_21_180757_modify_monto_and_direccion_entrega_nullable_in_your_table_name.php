<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMontoAndDireccionEntregaNullableInYourTableName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('envios', function (Blueprint $table) {
            $table->double('Monto')->nullable()->change();
            $table->string('Direccion_entrega', 255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('envios', function (Blueprint $table) {
            $table->double('Monto')->nullable(false)->change();
            $table->string('Direccion_entrega', 255)->nullable(false)->change();
        });
    }
}

