<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPercentLimitSubguaranteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subguarantees', function (Blueprint $table) {
            $table->decimal('percent_limit', 5, 2)->nullable()->after('percent_covered');
            $table->string('required_capital')->default('')->after('max_deductible');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subguarantees', function (Blueprint $table) {
            $table->dropColumn(['percent_limit', 'required_capital']);
        });
    }
}
