<?php

use App\Traits\MigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoleDayDataTable extends Migration
{
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pole_day_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained();
            $table->timestamp('mon_on')->nullable();
            $table->timestamp('mon_off')->nullable();
            $table->timestamp('tue_on')->nullable();
            $table->timestamp('tue_off')->nullable();
            $table->timestamp('wed_on')->nullable();
            $table->timestamp('wed_off')->nullable();
            $table->timestamp('thu_on')->nullable();
            $table->timestamp('thu_off')->nullable();
            $table->timestamp('fri_on')->nullable();
            $table->timestamp('fri_off')->nullable();
            $table->timestamp('sat_on')->nullable();
            $table->timestamp('sat_off')->nullable();
            $table->timestamp('sun_on')->nullable();
            $table->timestamp('sun_off')->nullable();
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
        Schema::dropIfExists('pole_day_data');
    }
}
