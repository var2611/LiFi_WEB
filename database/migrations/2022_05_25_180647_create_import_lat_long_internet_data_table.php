<?php

use App\Traits\MigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportLatLongInternetDataTable extends Migration
{
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_lat_long_internet_data', function (Blueprint $table) {
            $table->id();
            $table->string('group_id')->nullable();
            $table->string('name')->nullable();
            $table->float('latitude', 10, 6)->nullable();
            $table->float('longitude', 10, 6)->nullable();
            $table->string('block')->nullable();
            $table->string('district')->nullable();
            $table->string('zone')->nullable();
            $table->string('state')->nullable();
            $table->string('file_name')->nullable();
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
        Schema::dropIfExists('import_lat_long_internet_data');
    }
}
