<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultProductRamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ramos', function (Blueprint $table) {
            $table->foreignId('default_product_id')->nullable()->after('preexistence_class_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ramos', function (Blueprint $table) {
            $table->dropColumn(['default_product_id']);
        });
    }
}
