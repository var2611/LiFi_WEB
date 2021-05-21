<?php

use App\Traits\MigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoleLightsTable extends Migration
{
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pole_lights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained();
            $table->tinyInteger('status')->nullable()->default('0');
            $table->tinyInteger('brightness')->nullable()->default('100');
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
        Schema::dropIfExists('pole_lights');
    }
}
