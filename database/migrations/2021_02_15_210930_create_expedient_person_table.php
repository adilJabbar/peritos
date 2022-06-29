<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedientPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedient_person', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expedient_id');
            $table->foreignId('person_id');
            $table->foreignId('address_id');
            $table->string('type');
            $table->decimal('amount', 10, 2);
            $table->foreignId('currency_id');
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
        Schema::dropIfExists('expedient_person');
    }
}
