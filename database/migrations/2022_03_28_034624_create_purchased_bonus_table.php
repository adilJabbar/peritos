<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasedBonusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // A client with a contract can purchase a video bonus with minutes
        // This purchase creates a sale_row and a sale
        // These minutes are in the client profile and will be used when
        // the minutes included in the package are completely used before the next renewal

        Schema::create('purchased_bonus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->comment('id of the contract');
            $table->foreignId('user_id')->comment('user who purchases this bonus');
            $table->integer('minutes')->comment('minutes included in the purchased bonus');
            $table->boolean('auto_renewal')->default(false)->comment('the client want to renew the bonus automatically when it is used');
            $table->float('amount')->comment('price of the purchased bonus');
            $table->string('currency');
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
        Schema::dropIfExists('purchased_bonus');
    }
}
