<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // This table contains the information about the packages
        // that are available in the website.
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Name of the package');
            $table->integer('expedients')->comment('Number of new expedients included each month/renewal.');
            $table->integer('users')->comment('Number of users included in the package');
            $table->decimal('video_minutes')->comment('Number of minutes video-call is available in the package. This will be reset every renewal');
            $table->decimal('usd_month')->comment('Price in USD for the package if monthly contract is selected');
            $table->decimal('usd_year')->comment('Price in USD for the package if yearly contract is selected');
            $table->decimal('usd_expedient')->comment('Extra charge for each expedient created on a period after having used the maximum number of expedients included');
            $table->decimal('usd_user')->comment('Extra charge for each user after having used the maximum number of users included');
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
        Schema::dropIfExists('packages');
    }
}
