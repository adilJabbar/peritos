<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiskdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riskdetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('risksubgroup_id');
            $table->string('description');
            $table->decimal('national_modificator', 5, 4)->default(1);
            $table->decimal('vpo_modificator', 5, 4)->default(0.8);
            $table->decimal('low_modificator', 5, 4)->default(0.9);
            $table->decimal('high_modificator', 5, 4)->default(1.1);
            $table->decimal('luxe_modificator', 5, 4)->default(1.2);
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
        Schema::dropIfExists('riskdetails');
    }
}
