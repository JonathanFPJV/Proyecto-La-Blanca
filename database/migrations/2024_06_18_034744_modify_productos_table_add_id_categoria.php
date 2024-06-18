<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyProductosTableAddIdCategoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_categoria')->nullable()->after('Color');
            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('set null');
            $table->dropColumn('Categoria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->string('Categoria')->after('Color');
            $table->dropForeign(['id_categoria']);
            $table->dropColumn('id_categoria');
        });
    }
}

