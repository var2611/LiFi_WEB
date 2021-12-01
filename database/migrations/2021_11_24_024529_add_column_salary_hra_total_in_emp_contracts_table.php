<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSalaryHraTotalInEmpContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emp_contracts', function (Blueprint $table) {
            $table->renameColumn('amount', 'salary_basic');
            $table->string('salary_hra')->after('amount')->nullable();
            $table->string('salary_total')->after('salary_hra')->nullable();
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
