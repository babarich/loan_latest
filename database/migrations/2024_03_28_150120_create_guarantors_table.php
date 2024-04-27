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
        Schema::create('guarantors', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('title')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('date_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('working_status')->nullable();
            $table->string('business_name')->nullable();
            $table->longText('filename')->nullable();
            $table->string('attachment_size')->nullable();
            $table->text('attachment')->nullable();
            $table->integer('uploaded_by')->nullable();
            $table->string('status')->nullable();
            $table->text('description')->nullable();
            $table->string('stage')->nullable();
            $table->integer('approver_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('approver_second_id')->nullable();
            $table->foreignId('com_id')->references('id')->on('companies')->onDelete('cascade');
            $table->timestamp('approved_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guarantors');
    }
};
