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
            if (!Schema::hasColumn('users', 'apellido')) {
                $table->string('apellido', 45)->nullable();
            }
            if (!Schema::hasColumn('users', 'nombreusuario')) {
                $table->string('nombreusuario', 45)->nullable();
            }
            if (!Schema::hasColumn('users', 'direccion')) {
                $table->string('direccion', 45)->nullable();
            }
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar', 255)->nullable();
            }
            if (!Schema::hasColumn('users', 'avatar_original')) {
                $table->string('avatar_original', 255)->nullable();
            }
            if (!Schema::hasColumn('users', 'token')) {
                $table->string('token', 255)->nullable();
            }
            if (!Schema::hasColumn('users', 'telefono')) {
                $table->string('telefono', 45)->nullable();
            }
            if (!Schema::hasColumn('users', 'estado')) {
                $table->string('estado', 255)->nullable();
            }
            if (!Schema::hasColumn('users', 'ID_Tipo')) {
                $table->unsignedBigInteger('ID_Tipo')->nullable();
                $table->foreign('ID_Tipo')->references('ID_Tipo')->on('tipo_usuarios');
            }
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'apellido')) {
                $table->dropColumn('apellido');
            }
            if (Schema::hasColumn('users', 'nombreusuario')) {
                $table->dropColumn('nombreusuario');
            }
            if (Schema::hasColumn('users', 'direccion')) {
                $table->dropColumn('direccion');
            }
            if (Schema::hasColumn('users', 'avatar')) {
                $table->dropColumn('avatar');
            }
            if (Schema::hasColumn('users', 'avatar_original')) {
                $table->dropColumn('avatar_original');
            }
            if (Schema::hasColumn('users', 'token')) {
                $table->dropColumn('token');
            }
            if (Schema::hasColumn('users', 'telefono')) {
                $table->dropColumn('telefono');
            }
            if (Schema::hasColumn('users', 'estado')) {
                $table->dropColumn('estado');
            }
            if (Schema::hasColumn('users', 'ID_Tipo')) {
                $table->dropForeign(['ID_Tipo']);
                $table->dropColumn('ID_Tipo');
            }
        });
    }
    
    
};
