<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loan_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->references('id')->on('loans')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('filename')->nullable();
            $table->longText('file')->nullable();
            $table->string('attachment_size')->nullable();
            $table->text('attachment')->nullable();
            $table->integer('uploaded_by')->nullable();
            $table->string('type')->nullable();
            $table->foreignId('com_id')->references('id')->on('companies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_attachments');
    }
};
