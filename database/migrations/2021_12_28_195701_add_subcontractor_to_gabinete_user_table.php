<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubcontractorToGabineteUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gabinete_user', function (Blueprint $table) {
            $table->foreignId('subcontractor_id')->default(0)->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gabinete_user', function (Blueprint $table) {
            $table->dropColumn(['subcontractor_id']);
        });
    }
}
