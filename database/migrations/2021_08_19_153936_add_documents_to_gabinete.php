<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentsToGabinete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gabinetes', function (Blueprint $table) {
            $table->foreignId('advance_id')->default(1);
            $table->foreignId('preReport_id')->default(2);
            $table->foreignId('report_id')->default(3);
            $table->foreignId('invoice_id')->default(4);
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
            $table->dropColumn(['advance_id', 'preReport_id', 'report_id', 'invoice_id']);
        });
    }
}
