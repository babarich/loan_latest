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
        Schema::create('borrower_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('collector_name')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('com_id')->references('id')->on('companies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrower_groups');
    }
};
