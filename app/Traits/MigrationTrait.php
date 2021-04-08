<?php

namespace App\Traits;

use Illuminate\Database\Schema\Blueprint;

trait MigrationTrait
{
    public function runColumns(Blueprint $table)
    {
        $table->tinyInteger('is_active')->default('0');
        $table->tinyInteger('is_visible')->default('0');
        $table->string('created_by');
        $table->string('updated_by');
        $table->string('deleted_by')->nullable();;
        $table->timestamps();
        $table->softDeletes();
    }
}
