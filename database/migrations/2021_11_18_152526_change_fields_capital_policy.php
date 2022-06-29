<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldsCapitalPolicy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('capital_policy', function (Blueprint $table) {
            $table->decimal('perc_cia', 5, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('capital_policy', function (Blueprint $table) {
            $table->decimal('perc_cia', 8, 2)->change();
        });
    }
}
