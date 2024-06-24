<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCantidadNullableInLogisticasTable extends Migration
{
    public function up()
    {
        Schema::table('logisticas', function (Blueprint $table) {
            $table->integer('Cantidad')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('logisticas', function (Blueprint $table) {
            $table->integer('Cantidad')->default(1)->change();
        });
    }
}

