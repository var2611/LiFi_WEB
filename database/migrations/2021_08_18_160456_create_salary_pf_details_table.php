<?php

use App\Traits\MigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryPfDetailsTable extends Migration
{
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_pf_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salary_id')->constrained();
            $table->string('name')->nullable();
            $table->string('pf_wages')->comment('pf_salary')->nullable();
            $table->string('ee_amount')->nullable();
            $table->string('er_amount')->nullable();
            $table->string('pension_amount')->nullable();
            $table->string('ee_total_amount')->nullable();
            $table->string('er_total_amount')->nullable();
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
        Schema::dropIfExists('pf_details');
    }
}
