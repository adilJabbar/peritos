<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsCapitalProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('capital_product', function (Blueprint $table) {
            $table->boolean('derog_reg_prop')->default(false)->after('product_id');
            $table->float('derog_amount', 16, 2)->nullable()->after('derog_reg_prop');
            $table->float('derog_percent')->nullable()->after('derog_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('capital_product', function (Blueprint $table) {
            $table->dropColumn(['derog_reg_prop', 'derog_amount', 'derog_percent']);
        });
    }
}
