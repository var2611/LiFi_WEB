<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmpPfIdInSalaryPfDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salary_pf_details', function (Blueprint $table) {
            $table->foreignId('emp_pf_detail_id')->nullable()->unsigned()->after('salary_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salary_pf_details', function (Blueprint $table) {
            //
        });
    }
}
