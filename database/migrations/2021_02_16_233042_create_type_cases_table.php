<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typecases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ramo_id');
            $table->string('name');
            $table->string('texts')->nullable();
            $table->boolean('preexistences')->default(false);
            $table->boolean('tasacion')->default(false);
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
        Schema::dropIfExists('type_cases');
    }
}
