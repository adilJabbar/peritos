<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->comment('id of the session from the video provider');
            $table->morphs('videoable');
            $table->string('path')->comment('path to the file where the video is stored');
            $table->dateTime('start_time')->comment('start_time of the video');
            $table->dateTime('end_time')->comment('end time of the video');
            $table->foreignId('user_id')->comment('user who started the call');
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
        Schema::dropIfExists('video_sessions');
    }
}
