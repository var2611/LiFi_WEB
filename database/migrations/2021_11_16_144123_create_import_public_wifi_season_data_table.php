<?php

use App\Traits\MigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportPublicWifiSeasonDataTable extends Migration
{
    use MigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_public_wifi_season_data', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('full_mobile')->nullable();
            $table->string('isd_code')->nullable();
            $table->string('country_name')->nullable();
            $table->string('time_spent')->nullable();
            $table->string('time_spent_sec')->nullable();
            $table->string('download_data')->nullable();
            $table->string('upload_data')->nullable();
            $table->string('total_data')->nullable();
            $table->string('mac_address')->nullable();
            $table->string('device_type')->nullable();
            $table->string('device_model')->nullable();
            $table->string('public_ip')->nullable();
            $table->string('private_ip')->nullable();
            $table->string('login_time')->nullable();
            $table->string('logout_time')->nullable();
            $table->string('location_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_public_wifi_season_data');
    }
}
