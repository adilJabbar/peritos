<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // These are the bonuses that a gabinete can buy in addition to the subscription package
        // When a bonus is purchased and the sale, a purchased bonus related to the client contract is created
        Schema::create('video_bonuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('name of the bonus');
            $table->integer('minutes')->comment('minutes included in the bonus');
            $table->float('amount')->comment('price of the bonus');
            $table->string('stripe_id')->nullable()->comment('ID of this package in Stripe (if needed)');
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
        Schema::dropIfExists('video_bonuses');
    }
}
