<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->foreignId('currency_id');
            $table->decimal('taxes', 5, 2);
            $table->decimal('reduced_taxes', 5, 2)->nullable();
            $table->decimal('precio_m', 16, 2)->nullable();
            $table->decimal('seg_salud', 16, 2)->nullable();
            $table->decimal('benef_ind_perc', 5, 2)->nullable();
            $table->decimal('gastos_generales_perc', 5, 2)->nullable();
            $table->decimal('arquitecto_perc', 5, 2)->nullable();
            $table->decimal('license_perc', 5, 2)->nullable();
            $table->integer('furniture')->nullable();
            $table->integer('room')->nullable();
            $table->integer('person')->nullable();
            $table->integer('anexo')->nullable();
            $table->string('flag')->nullable();
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
        Schema::dropIfExists('countries');
    }
}
