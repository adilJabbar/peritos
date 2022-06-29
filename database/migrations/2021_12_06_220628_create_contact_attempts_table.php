<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expedient_id');
            $table->timestamp('time');
            $table->foreignId('user_id');
            $table->string('attempt_type');
            $table->string('attempt_value');
            $table->boolean('get_response')->default(false);
            $table->string('comments')->nullable();
            $table->text('response')->nullable();
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
        Schema::dropIfExists('contact_attempts');
    }
}
