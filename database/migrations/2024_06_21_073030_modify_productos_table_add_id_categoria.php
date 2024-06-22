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
        Schema::table('productos', function (Blueprint $table) {
            if (!Schema::hasColumn('productos', 'id_categoria')) {
                $table->unsignedBigInteger('id_categoria')->nullable()->after('Color');
                $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('set null');
            }
        });
    }
    
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            if (Schema::hasColumn('productos', 'id_categoria')) {
                $table->dropForeign(['id_categoria']);
                $table->dropColumn('id_categoria');
            }
        });
    }
    
    
};
