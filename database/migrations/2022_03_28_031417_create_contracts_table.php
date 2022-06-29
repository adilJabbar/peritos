<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // This table manages store the information of any purchase
        // created by a loss adjuster company (gabinete)
        // If the client change the package or the conditions of the package change
        // for a client, the contract will expire and a new contract will be created.
        // Each renewal creates a sales withe contract renewal information
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gabinete_id')->comment('Loss adjuster company that purchases the app');
            $table->dateTime('purchase_time')->comment('time when the contract starts');
            $table->foreignId('user_id')->comment('user who creates the contract');
            $table->boolean('auto_renewal')->default(true)->comment('True or false: this contract should be automatically renewed on expiration');
            $table->dateTime('renewal_time')->comment('time when the contract has been renewed');
            $table->string('contract_length')->comment('month or annual');
            $table->dateTime('expiration_time')->comment('time when the contract expires and must be renewed if auto renewal is set');
            $table->foreignId('package_id')->comment('id of the package purchased');
//            These conditions must be copied from the package to each contract, because the packages can be updated in the future.
            $table->integer('expedients')->comment('Number of new expedients included each new renewal in this contract');
            $table->integer('users')->comment('Number of users included in this contract');
            $table->decimal('video_minutes')->comment('Number of minutes video-call is available in the package. This will be reset every renewal');
            $table->integer('total_users')->comment('Number of extra users active in this contract, which difference will be billed in every renewal if it is bigger than users');
//            TODO Decide how to manage the currency when a purchase is done
            $table->decimal('usd_renewal')->comment('Price in USD to charge each renewal');
            $table->decimal('usd_expedient')->comment('Extra charge for each expedient created on a period after having used the maximum number of expedients included');
            $table->decimal('usd_user')->comment('Extra charge for each user after having used the maximum number of users included');
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
        Schema::dropIfExists('contracts');
    }
}
