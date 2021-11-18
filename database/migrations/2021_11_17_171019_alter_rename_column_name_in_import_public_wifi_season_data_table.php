<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRenameColumnNameInImportPublicWifiSeasonDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('import_public_wifi_season_data', function (Blueprint $table) {
            $table->renameColumn('full_mobile', 'mobile_with_isd_code');
            $table->renameColumn('country_name', 'sms_request_country');
            $table->renameColumn('time_spent_sec', 'session_time');
            $table->renameColumn('mac_address', 'user_mac');
            $table->renameColumn('login_time', 'login_start_time');
            $table->renameColumn('logout_time', 'login_stop_time');
            $table->string('converted_session_time')->nullable();
            $table->string('converted_total_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('import_public_wifi_season_data', function (Blueprint $table) {
            //
        });
    }
}
