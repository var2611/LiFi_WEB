<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMacAndLocationToPolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poles', function (Blueprint $table) {
            $table->string('mac_address')->after('name');
            $table->string('location')->after('name');
            $table->string('latitude')->after('name');
            $table->string('longitude')->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poles', function (Blueprint $table) {
            //
        });
    }
}
