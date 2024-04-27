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
        Schema::table('loan_comments', function (Blueprint $table) {
            $table->foreign(['loan_id'])->references(['id'])->on('loans')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loan_comments', function (Blueprint $table) {
            $table->dropForeign('loan_comments_loan_id_foreign');
        });
    }
};
