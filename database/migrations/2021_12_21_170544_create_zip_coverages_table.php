<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZipCoveragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zip_coverages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('gabinete_id');
            $table->foreignId('country_id');
            $table->unsignedInteger('from');
            $table->unsignedInteger('to');
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('zip_coverages');
    }
}
