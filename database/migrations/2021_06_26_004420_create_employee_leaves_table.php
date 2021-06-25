<?php

use App\Traits\MigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeLeavesTable extends Migration
{
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('tl_id')->unsigned()->nullable();;
            $table->integer('manager_id')->unsigned()->nullable();;
            $table->foreignId('leave_type_id')->constrained();
            $table->date('date_from');
            $table->date('date_to');
            $table->time('from_time');
            $table->time('to_time');
            $table->string('days')->nullable();;
            $table->tinyInteger('status')->default(0)->comment('0 = Unapproved, 1 = Approved');
            $table->string('remarks')->nullable();;
            $table->string('reason');
            $this->runColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employee_leaves');
    }
}
