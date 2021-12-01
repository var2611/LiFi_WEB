<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUanAndUniqueInEmpPfDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emp_pf_details', function (Blueprint $table) {
            $table->string('uan')->nullable()->after('account_number');
            $table->unique(['user_id', 'account_number', 'uan'], 'unique_pf_detail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emp_pf_details', function (Blueprint $table) {
            //
        });
    }
}
