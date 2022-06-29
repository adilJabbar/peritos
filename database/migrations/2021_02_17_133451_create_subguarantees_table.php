<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubguaranteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subguarantees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('percent_covered', 3, 2)->default(1);
            $table->unsignedInteger('limit')->nullable();
            $table->decimal('percent_deductible', 3, 2)->nullable();
            $table->unsignedInteger('min_deductible')->nullable();
            $table->unsignedInteger('max_deductible')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('included')->default('1');
            $table->boolean('primer_riesgo')->default('0');
            $table->foreignId('guarantee_id');
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
        Schema::dropIfExists('subguarantees');
    }
}
