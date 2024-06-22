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
        Schema::create('envios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('n_envio', 45);
            $table->double('Monto');
            $table->date('Fecha_ENTREGA');
            $table->string('Direccion_entrega', 255);
            $table->string('Estado', 45);
            $table->timestamps();
    
            $table->unique('n_envio');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('envios');
    }
    
};
