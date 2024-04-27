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
        Schema::create('loan_schedule_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->references('id')->on('loans')->onDelete('cascade');
            $table->timestamp('date')->nullable();
            $table->decimal('amount', 40,2)->nullable();
            $table->string('method')->nullable();
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
        Schema::dropIfExists('loan_schedule_payments');
    }
};
