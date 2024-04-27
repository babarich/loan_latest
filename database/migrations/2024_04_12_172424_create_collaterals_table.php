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
        Schema::create('collaterals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('loan_id');
            $table->integer('type_id')->nullable();
            $table->string('name')->nullable();
            $table->string('product_name')->nullable();
            $table->decimal('amount', 40)->nullable();
            $table->timestamp('date')->nullable();
            $table->string('condition')->nullable();
            $table->text('description')->nullable();
            $table->text('attachment')->nullable();
            $table->string('filename')->nullable();
            $table->string('attachment_size')->nullable();
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
        Schema::dropIfExists('collaterals');
    }
};
