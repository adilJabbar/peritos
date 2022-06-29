<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsedBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // when a video-call is going to start, we check the available minutes at that time
        // including the renewal and any bonus, inform the client and manage the call.

        // when a video call finishes, if the total video-calls for the gabinete
        // started after the last renewal is bigger than the total minutes
        // included in the renewal, we create a row using the excess of time from this
        // call.

        Schema::create('used_bonuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchased_bonus_id')->comment('id of the purchased bonus this line belongs to');
            $table->foreignId('video_session_id')->comment('id of hte video session');
            $table->float('minutes')->comment('minutes that will be used from the purchased bonus');
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
        Schema::dropIfExists('used_bonuses');
    }
}
