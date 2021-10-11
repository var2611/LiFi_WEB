<?php

use App\Traits\MigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpContractTypesTable extends Migration
{
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_contract_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->date('date');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('days')->nullable();
            $table->string('working_hours')->nullable();
            $table->foreignId('emp_contract_status_id')->nullable()->constrained();
            $table->foreignId('emp_contract_amount_type_id')->nullable()->constrained();
            $table->string('amount')->nullable();
            $table->foreignId('emp_work_shift_id')->nullable()->constrained();
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
        Schema::dropIfExists('emp_contract_types');
    }
}
