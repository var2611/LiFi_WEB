<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsInSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salaries', function (Blueprint $table) {
            $table->renameColumn('contract_amount', 'salary_contract_basic');
            $table->string('salary_contract_total')->after('absent_days')->nullable();
            $table->string('salary_contract_hra')->after('absent_days')->nullable();
            $table->renameColumn('basic', 'salary_basic');
            $table->renameColumn('hra', 'salary_hra');
            $table->dropColumn('salary_amount');
            $table->renameColumn('gross_earning', 'salary_gross_earning');
            $table->renameColumn('gross_deduction', 'salary_gross_deduction');
            $table->renameColumn('net_pay', 'salary_net_pay');
        });

        DB::statement("ALTER TABLE `salaries` MODIFY COLUMN `salary_total` varchar(255) null AFTER `salary_hra`");
        DB::statement("ALTER TABLE `salaries` MODIFY COLUMN `salary_contract_basic` varchar(255) null AFTER `absent_days`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salaries', function (Blueprint $table) {
            //
        });
    }
}
