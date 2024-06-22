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
        Schema::table('users', function (Blueprint $table) {
            $table->string('apellido', 45)->nullable();
            $table->string('nombreusuario', 45)->nullable();
            $table->string('direccion', 45)->nullable();
            $table->string('avatar', 255)->nullable();
            $table->string('avatar_original', 255)->nullable();
            $table->string('token', 255)->nullable();
            $table->string('telefono', 45)->nullable();
            $table->string('estado', 255)->nullable();
            $table->unsignedBigInteger('ID_Tipo')->nullable();
            $table->foreign('ID_Tipo')->references('ID_Tipo')->on('tipo_usuarios');
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['apellido', 'nombreusuario', 'direccion', 'avatar', 'avatar_original', 'token', 'telefono', 'estado', 'ID_Tipo']);
        });
    }
    
};
