<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextAdjustersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_adjusters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expedient_id');
            $table->string('attended_by')->nullable();
            $table->text('chronology')->nullable();
            $table->text('adjuster')->nullable();
            $table->text('damages')->nullable();
            $table->text('evaluations')->nullable();
            $table->text('coverage')->nullable();
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
        Schema::dropIfExists('text_adjusters');
    }
}
