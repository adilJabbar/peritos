<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeQualityToHomePreexistencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_preexistences', function (Blueprint $table) {
            $table->string('maintenance')->nullable()->change();
//            $table->decimal('maintenance_perc')->nullable()->after('maintenance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_preexistences', function (Blueprint $table) {
            $table->decimal('maintenance')->nullable()->change();
//            $table->dropColumn(['maintenance_perc']);
        });
    }
}
