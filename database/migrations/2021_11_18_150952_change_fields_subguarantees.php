<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldsSubguarantees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subguarantees', function (Blueprint $table) {
            $table->decimal('percent_covered', 5, 2)->default(100)->change();
            $table->decimal('percent_deductible', 5, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subguarantees', function (Blueprint $table) {
            $table->decimal('percent_covered', 3, 2)->default(1)->change();
            $table->decimal('percent_deductible', 3, 2)->change();
        });
    }
}
