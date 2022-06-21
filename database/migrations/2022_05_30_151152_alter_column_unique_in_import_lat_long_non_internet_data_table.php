<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnUniqueInImportLatLongNonInternetDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('import_lat_long_non_internet_data', function (Blueprint $table) {
            $table->unique(['name','latitude', 'longitude'], 'unique_non_internet_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('import_lat_long_non_internet_data', function (Blueprint $table) {
            //
        });
    }
}
