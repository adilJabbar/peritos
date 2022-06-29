<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToCompanyGabineteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_gabinete', function (Blueprint $table) {
            $table->foreignId('default_assign_user')->nullable()->after('company_id');
            $table->foreignId('default_backoffice_user')->nullable()->after('default_assign_user');
//            $table->foreignId('default_assign_user')->nullable()->after('company_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_gabinete', function (Blueprint $table) {
            $table->dropColumn(['default_assign_user', 'default_backoffice_user']);
        });
    }
}
