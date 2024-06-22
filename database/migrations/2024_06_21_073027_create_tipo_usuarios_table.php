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
        Schema::create('tipo_usuarios', function (Blueprint $table) {
            $table->bigIncrements('ID_Tipo');
            $table->string('Nombre_tipo', 45);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('tipo_usuarios');
    }
    
};
