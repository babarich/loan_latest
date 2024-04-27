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
        Schema::table('collaterals', function (Blueprint $table) {
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
        Schema::table('collaterals', function (Blueprint $table) {
            $table->dropForeign('collaterals_loan_id_foreign');
        });
    }
};
