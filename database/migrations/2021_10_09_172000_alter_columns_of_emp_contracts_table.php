<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsOfEmpContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emp_contracts', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('emp_contract_amount_type_id');
            $table->foreignId('emp_contract_status_id')->after('status')->constrained();
            $table->foreignId('emp_contract_type_id')->after('status')->constrained();
            $table->foreignId('emp_work_shift_id')->after('amount')->nullable()->constrained();
            $table->string('name')->nullable()->change();
            $table->string('hours')->nullable()->after('end_date');
            $table->string('end_time')->nullable()->after('end_date');
            $table->string('start_time')->nullable()->after('end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
