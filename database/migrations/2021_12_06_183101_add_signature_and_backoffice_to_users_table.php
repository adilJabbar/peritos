<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSignatureAndBackofficeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('signature')->nullable()->after('country_id');
            $table->foreignId('backoffice_id')->nullable()->after('signature');
            $table->foreignId('supervisor_id')->nullable()->after('backoffice_id');
            $table->boolean('supervised_advances')->default(true)->after('supervisor_id');
            $table->boolean('supervised_reports')->default(true)->after('supervised_advances');
            $table->boolean('supervised_incidences')->default(true)->after('supervised_reports');
            $table->boolean('contact_to_company')->default(false)->after('supervised_incidences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['signature', 'backoffice_id', 'supervisor_id', 'supervised_advances', 'supervised_reports', 'supervised_incidences', 'contact_to_company']);
        });
    }
}
