<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsToPolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poles', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('mac_address')->nullable()->change();
            $table->string('location')->nullable()->change();
            $table->string('latitude')->nullable()->change();
            $table->string('longitude')->nullable()->change();
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
