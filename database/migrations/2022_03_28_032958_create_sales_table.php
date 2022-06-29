<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->comment('Id of the contract this sales belongs to');
            $table->dateTime('date')->comment('date of the transaction');
            $table->string('payment_id')->comment('id to identify this payment in the payment provider');
            $table->float('taxes')->comment('taxes amount if included in the transaction');
            $table->float('paid_amount')->comment('amount paid');
            $table->string('currency')->default('USD')->comment('currency identifier');
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
        Schema::dropIfExists('sales');
    }
}
