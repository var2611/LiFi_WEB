<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsOvertimeToNullableInSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salaries', function (Blueprint $table) {
            $table->dropConstrainedForeignId('overtime_type_id');
        });

        Schema::table('salaries', function (Blueprint $table) {
            $table->foreignId('overtime_type_id')->constrained();
        });

        DB::statement("ALTER TABLE `salaries` MODIFY COLUMN `overtime_type_id` bigint unsigned null AFTER `salary_total`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nullable_in_salaries', function (Blueprint $table) {
            //
        });
    }
}
