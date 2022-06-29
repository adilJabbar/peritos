<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessPreexistencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_preexistences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('riskdetail_id');
            $table->integer('dimension')->nullable();
            $table->integer('year')->nullable();
            $table->string('owner')->nullable();
            $table->string('user')->nullable();
            $table->string('used_as')->nullable();
            $table->string('structure')->nullable();
            $table->string('roof')->nullable();
            $table->string('wall')->nullable();
            $table->integer('rooms')->nullable();
            $table->string('quality')->nullable();
            $table->decimal('quality_perc')->nullable();
            $table->decimal('maintenance')->nullable();
            $table->integer('people')->nullable();
            $table->string('furniture')->nullable();
            $table->decimal('furniture_perc')->nullable();
            $table->string('amount')->nullable();
            $table->decimal('amount_perc')->nullable();
            $table->boolean('pets')->default(false);
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
        Schema::dropIfExists('business_preexistences');
    }
}
