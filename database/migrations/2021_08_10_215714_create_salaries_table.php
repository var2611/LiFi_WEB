<?php

use App\Traits\MigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_employee_id')->constrained();
            $table->foreignId('contract_id')->constrained();
            $table->string('name')->nullable();
            $table->date('date')->nullable();
            $table->string('contract_amount')->nullable();
            $table->string('salary_amount')->nullable();
            $table->foreignId('overtime_type_id')->constrained();
            $table->string('overtime_amount')->nullable();
            $table->string('salary_total')->nullable();
            $table->string('gross_earning')->nullable();
            $table->string('gross_deduction')->nullable();
            $table->string('net_pay')->nullable();
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
        Schema::dropIfExists('salaries');
    }
}
