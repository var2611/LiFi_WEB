<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterChangeColumnEmpWorkShiftIdInEmpContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emp_contracts', function (Blueprint $table) {
            $table->unsignedBigInteger('emp_shift_data_id')->after('amount')->nullable();
            $table->foreign('emp_shift_data_id')->references('id')->on('emp_shift_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emp_contracts', function (Blueprint $table) {
            //
        });
    }
}
