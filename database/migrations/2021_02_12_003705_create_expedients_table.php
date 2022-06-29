<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpedientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedients', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('code')->nullable();
            $table->string('full_code')->nullable();
            $table->datetime('requested_at');
            $table->date('happened_at')->nullable();
            $table->datetime('expires_at')->nullable();
            $table->morphs('billable');
            $table->foreignId('billable_address_id')->nullable();
            $table->string('priority')->default('normal');
            $table->string('reference')->nullable();
            $table->text('description')->nullable();
            $table->text('private_comments')->nullable();
            $table->foreignId('ramo_id')->nullable();
            $table->foreignId('address_id')->nullable();
            $table->foreignId('person_id')->nullable();
            $table->foreignId('agent_id')->nullable();
            $table->foreignId('adjuster_id')->nullable();
            $table->foreignId('status_id')->default('1');
            $table->foreignId('gabinete_id');
            $table->foreignId('creator_id');
            $table->boolean('requires_policy')->default(false);
            $table->foreignId('policy_id')->nullable();
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
        Schema::dropIfExists('expedients');
    }
}
