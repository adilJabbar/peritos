<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->comment('sale id this row belongs to. It can be a renewal, extra users...');
            $table->string('description')->comment('Description of the row');
            $table->integer('units')->comment('units');
            $table->float('unit_price')->comment('unit price');
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
        Schema::dropIfExists('sale_rows');
    }
}
