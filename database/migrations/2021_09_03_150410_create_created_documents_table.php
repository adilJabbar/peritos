<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreatedDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('created_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expedient_id');
            $table->foreignId('document_version_id');
            $table->decimal('reserve', 12, 2)->nullable();
            $table->decimal('proposed', 12, 2)->nullable();
            $table->decimal('excluded', 12, 2)->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('reviewed_by')->nullable();
            $table->date('sent_at')->nullable();
            $table->string('path');
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
        Schema::dropIfExists('created_documents');
    }
}
