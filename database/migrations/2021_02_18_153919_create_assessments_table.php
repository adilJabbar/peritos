<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expedient_id');
            $table->foreignId('person_id');
            $table->foreignId('capital_id');
            $table->foreignId('subguarantee_id');
            $table->foreignId('destiny_id')->default(1);
            $table->foreignId('currency_id')->default(1);
            $table->decimal('unit');
            $table->foreignId('deprecationgroup_id')->nullable();
            $table->string('description');
            $table->decimal('unit_price', 12, 2);
            $table->decimal('taxes', 5, 2)->nullable();
            $table->decimal('deprecation')->nullable();
            $table->string('origin', 512)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessments');
    }
}
