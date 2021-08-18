<?php

use App\Traits\MigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpContractsTable extends Migration
{
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_employee_id')->constrained();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->date('date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('days')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('emp_contract_amount_type_id')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('emp_contracts');
    }
}
