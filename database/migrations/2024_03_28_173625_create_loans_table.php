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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->integer('loan_product')->nullable();
            $table->integer('borrower_id');
            $table->decimal('principle_amount', 60,2)->nullable();
            $table->string('interest_method')->nullable();
            $table->string('disbursement')->nullable();
            $table->string('interest_type')->nullable();
            $table->integer('interest_percentage')->nullable();
            $table->string('interest_duration')->nullable();
            $table->integer('loan_duration')->nullable();
            $table->string('duration_type')->nullable();
            $table->string('payment_cycle')->nullable();
            $table->integer('payment_number')->nullable();
            $table->decimal('interest_amount', 40,2)->nullable();
            $table->decimal('total_interest', 40,2)->nullable();
            $table->timestamp('loan_release_date')->nullable();
            $table->timestamp('maturity_date')->nullable();
            $table->integer('disbursed_by')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();
            $table->string('release_status')->nullable();
            $table->integer('guarantor_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->foreignId('com_id')->references('id')->on('companies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
