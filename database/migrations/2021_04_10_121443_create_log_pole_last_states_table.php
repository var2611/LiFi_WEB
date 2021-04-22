<?php

use App\Traits\MigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogPoleLastStatesTable extends Migration
{
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_pole_last_states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pole_id')->constrained();
            $table->string('change_value_code')->nullable();
            $table->string('change_value')->nullable();
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
        Schema::dropIfExists('log_pole_last_states');
    }
}
