<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorsToGabinetes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gabinetes', function (Blueprint $table) {
            $table->string('main_color_text')->nullable()->after('main_color');
            $table->string('secondary_color_text')->nullable()->after('secondary_color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gabinetes', function (Blueprint $table) {
            $table->dropColumn(['main_color_text', 'secondary_color_text']);
        });
    }
}
