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
        Schema::table('payment_loans', function (Blueprint $table) {
            $table->string('bank')->nullable();
            $table->string('mobile')->nullable();
            $table->string('reference')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_loans', function (Blueprint $table) {
            //
        });
    }
};
