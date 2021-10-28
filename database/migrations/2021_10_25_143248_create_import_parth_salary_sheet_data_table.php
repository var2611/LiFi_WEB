<?php

use App\Traits\MigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportParthSalarySheetDataTable extends Migration
{
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_parth_salary_sheet_data', function (Blueprint $table) {
            $table->id();
            $table->string('UAN')->nullable();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('description')->nullable();
            $table->string('date_of_join')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('department')->nullable();
            $table->string('category')->nullable();
            $table->string('minimum_wages')->nullable();
            $table->string('days_total')->nullable();
            $table->string('holiday')->nullable();
            $table->string('days_absent')->nullable();
            $table->string('days_working')->nullable();
            $table->string('amount_advance_recovery')->nullable();
            $table->string('amount_room_rent_excess')->nullable();
            $table->string('salary_gross')->nullable();
            $table->string('salary_basic')->nullable();
            $table->string('salary_hra')->nullable();
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
        Schema::dropIfExists('import_parth_salary_sheet_data');
    }
}
