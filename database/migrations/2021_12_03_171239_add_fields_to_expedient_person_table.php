<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToExpedientPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expedient_person', function (Blueprint $table) {
            $table->text('notes')->nullable()->after('currency_id');
            $table->string('company')->nullable()->after('notes');
            $table->string('policy')->nullable()->after('company');
            $table->string('case')->nullable()->after('policy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expedient_person', function (Blueprint $table) {
            $table->dropColumn(['notes', 'company', 'policy', 'case']);
        });
    }
}
