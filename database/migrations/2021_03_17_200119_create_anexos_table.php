<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnexosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anexos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expedient_id');
            $table->string('name');
            $table->string('path');
            $table->string('comments')->nullable();
            $table->boolean('avance')->default(false);
            $table->boolean('prereport')->default(false);
            $table->boolean('report')->default(false);
            $table->boolean('incidencia')->default(false);
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
        Schema::dropIfExists('anexos');
    }
}
