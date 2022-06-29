<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapitalPolicyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capital_policy', function (Blueprint $table) {
            $table->id();
            $table->foreignId('capital_id');
            $table->foreignId('policy_id');
            $table->decimal('amount', 16, 2)->nullable();
            $table->boolean('primer_riesgo')->default(false);
            $table->decimal('perc_cia')->default(100);
            $table->decimal('reposicion', 16, 2)->nullable();
            $table->decimal('deprecation')->nullable();
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
        Schema::dropIfExists('capital_policy');
    }
}
