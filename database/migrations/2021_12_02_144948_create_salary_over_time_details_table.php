<?php

use App\Traits\MigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryOverTimeDetailsTable extends Migration
{
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_overtime_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_id')->constrained();
            $table->foreignId('attendances_id')->constrained();
            $table->foreignId('overtime_type_id')->constrained();
            $table->date('date')->nullable();
            $table->string('type')->nullable();
            $table->string('description')->nullable();
            $table->unique(['salary_id', 'attendances_id', 'overtime_type_id'], 'unique_ot_detail_per_day');
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
        Schema::dropIfExists('salary_over_time_details');
    }
}
