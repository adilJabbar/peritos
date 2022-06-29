<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_attempts', function (Blueprint $table) {
            $table->id();
            $table->dateTime('purchase_time')->comment('time when the transaction starts');
            $table->foreignId('gabinete_id')->comment('gabinete transaction');
            $table->foreignId('user_id')->comment('user who creates the transaction');
            $table->string('session_id');
            $table->foreignId('contract_id')->nullable();
            $table->string('stripe_checkout_session_id');
            $table->foreignId('package_id')->comment('id of the package purchased');
            $table->string('renewal_time')->comment('monthly or yearly');
            $table->decimal('usd_renewal')->comment('Price in USD to charge each renewal');
            $table->string('stripe_price_id')->comment('stripe of the package purchased');
            $table->boolean('updated')->comment('Create contact done or not')->default(0);
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
        Schema::dropIfExists('transaction_attempts');
    }
}
