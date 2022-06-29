<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDateTimeFieldToVisitAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visit_appointments', function (Blueprint $table) {
            $table->renameColumn('dateTime', 'date_time');
            $table->foreignId('user_id')->after('technician_id')->comment('This is the user that created the visit appointment');
            $table->foreignId('contact_attempt_id')->after('user_id');
            $table->float('kms')->nullable()->after('country_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visit_appointments', function (Blueprint $table) {
            $table->renameColumn('date_time', 'dateTime');
            $table->dropColumn(['contact_attempt_id', 'kms']);
        });
    }
}
