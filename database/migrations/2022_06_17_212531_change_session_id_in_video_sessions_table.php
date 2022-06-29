<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_sessions', function (Blueprint $table) {
            $table->dropColumn('session_id');
            $table->string('roomName')->nullable()->comment('id of the room from the video provider');
            $table->string('path')->nullable()->comment('path to the file where the video is stored')->change();
            $table->dateTime('end_time')->nullable()->comment('end time of the video')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_sessions', function (Blueprint $table) {
            $table->dropColumn('roomName');
            $table->string('session_id')->comment('id of the session from the video provider');
            $table->string('path')->comment('path to the file where the video is stored')->change();
            $table->dateTime('end_time')->comment('end time of the video')->change();
        });
    }
};
