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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->decimal('amount',40,2)->nullable();
            $table->timestamp('date')->nullable();
            $table->integer('expenseyear')->nullable();
            $table->string('note')->nullable();
            $table->integer('categoryID')->nullable();
            $table->integer('chart_id')->nullable();
            $table->string('ref_no')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('payment_id')->nullable();
            $table->string('bank')->nullable();
            $table->string('mobile')->nullable();
            $table->foreignId('com_id')->references('id')->on('companies')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->uuid();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
