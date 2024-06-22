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
            if (!Schema::hasColumn('productos', 'image_1')) {
                $table->string('image_1', 255)->nullable();
            }
            if (!Schema::hasColumn('productos', 'image_2')) {
                $table->string('image_2', 255)->nullable();
            }
            if (!Schema::hasColumn('productos', 'image_3')) {
                $table->string('image_3', 255)->nullable();
            }
            if (!Schema::hasColumn('productos', 'image_4')) {
                $table->string('image_4', 255)->nullable();
            }
        });
    }
    
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            if (Schema::hasColumn('productos', 'image_1')) {
                $table->dropColumn('image_1');
            }
            if (Schema::hasColumn('productos', 'image_2')) {
                $table->dropColumn('image_2');
            }
            if (Schema::hasColumn('productos', 'image_3')) {
                $table->dropColumn('image_3');
            }
            if (Schema::hasColumn('productos', 'image_4')) {
                $table->dropColumn('image_4');
            }
        });
    }
    
    
};
