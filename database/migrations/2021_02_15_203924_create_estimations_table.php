<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expedient_id');
            $table->decimal('estimation', 10, 2)->nullable();
            $table->decimal('reparation', 10, 2)->nullable();
            $table->decimal('indemnization', 10, 2)->nullable();
            $table->decimal('not_covered', 10, 2)->nullable();
            $table->string('origin')->nullable();
            $table->foreignId('currency_id');
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
        Schema::dropIfExists('estimations');
    }
}
