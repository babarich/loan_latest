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
        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('financial_category_id')->nullable();
            $table->text('note')->nullable();
            $table->boolean('status')->default(false);
            $table->string('code')->nullable();
            $table->date('date')->nullable();
            $table->decimal('open_balance',40,2)->default(0);
            $table->integer('account_group_id')->nullable();
            $table->smallInteger('predefined')->default(0);
            $table->integer('chart_no')->nullable();
            $table->integer('chart_id')->nullable();
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
        Schema::dropIfExists('chart_of_accounts');
    }
};
