<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteUserEmpIdAddUserIdInSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salaries', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_employee_id');
            $table->foreignId('user_id')->constrained();
        });

        DB::statement("ALTER TABLE `salaries` MODIFY COLUMN `user_id` bigint unsigned not null AFTER `id`");
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
