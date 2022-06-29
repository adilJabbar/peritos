<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToGabineteUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gabinete_user', function (Blueprint $table) {
            $table->foreignId('backoffice_id')->default(0)->after('favorite');
            $table->foreignId('supervisor_id')->default(0)->after('backoffice_id');
            $table->boolean('supervised_advances')->default(false)->after('supervisor_id');
            $table->boolean('supervised_reports')->default(false)->after('supervised_advances');
            $table->boolean('supervised_incidences')->default(false)->after('supervised_reports');
            $table->boolean('contact_to_company')->default(true)->after('supervised_incidences');
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
            $table->dropColumn(['backoffice_id', 'supervisor_id', 'supervised_advances', 'supervised_reports', 'contactToCompany', 'supervisor_id']);
        });
    }
}
