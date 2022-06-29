<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlanUpgardeFiledInTransactionAttamptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transaction_attempts', function (Blueprint $table) {
            $table->boolean('is_plan_updated')->default(0)->comment('is plan upgrade or not');
            $table->foreignId('current_contract_id')->nullable()->comment('transaction id for current contracts table');
            $table->double('package_amount')->comment('transaction plan actual price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction_attempts', function (Blueprint $table) {
            $table->dropColumn('is_plan_updated');
            $table->dropColumn('current_contract_id');
            $table->dropColumn('package_amount');
        });
    }
}
