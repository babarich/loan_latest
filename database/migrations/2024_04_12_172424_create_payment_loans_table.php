<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('loan_id');
            $table->text('description')->nullable();
            $table->decimal('amount', 40)->nullable();
            $table->string('type')->nullable();
            $table->timestamp('payment_date')->nullable();
            $table->integer('user_id')->nullable();
            $table->foreignId('com_id')->references('id')->on('companies')->onDelete('cascade');
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
        Schema::dropIfExists('payment_loans');
    }
};
