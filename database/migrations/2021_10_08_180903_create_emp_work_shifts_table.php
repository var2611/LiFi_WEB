<?php

use App\Traits\MigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpWorkShiftsTable extends Migration
{
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_work_shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('hours')->nullable();
            $table->tinyInteger('mon')->nullable()->default('0');
            $table->tinyInteger('tue')->nullable()->default('0');
            $table->tinyInteger('wed')->nullable()->default('0');
            $table->tinyInteger('thur')->nullable()->default('0');
            $table->tinyInteger('fri')->nullable()->default('0');
            $table->tinyInteger('sat')->nullable()->default('0');
            $table->tinyInteger('sun')->nullable()->default('1');
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
        Schema::dropIfExists('emp_work_shifts');
    }
}
