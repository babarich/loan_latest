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
        Schema::create('loan_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->references('id')->on('loans')->onDelete('cascade');
            $table->foreignId('borrower_id')->references('id')->on('borrowers')->onDelete('cascade');
            $table->decimal('principle', 60,2)->nullable();
            $table->decimal('interest', 60,2)->nullable();
            $table->decimal('interest_paid', 40, 2)->default(0);
            $table->decimal('principal_paid', 40, 2)->default(0);
            $table->decimal('penalty', 40,2)->nullable();
            $table->decimal('fees', 40,2)->nullable();
            $table->timestamp('due_date')->nullable();
            $table->decimal('amount', 60,2)->nullable();
            $table->enum('status', ['pending','completed', 'partial','overdue','due'])->default('pending');
            $table->integer('user_id')->nullable();
            $table->boolean('paid')->default(false);
            $table->foreignId('com_id')->references('id')->on('companies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_schedules');
    }
};
