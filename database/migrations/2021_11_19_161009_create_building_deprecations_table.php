<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingDeprecationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_deprecations', function (Blueprint $table) {
            $table->id();
            $table->integer('years');
            $table->decimal('Excelente');
            $table->decimal('Bueno');
            $table->decimal('Regular');
            $table->decimal('Malo');
            $table->decimal('Lamentable');
            $table->decimal('Ruina');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('building_deprecations');
    }
}
