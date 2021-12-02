<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class SalaryDetail extends Model
{
    protected $fillable = [
        'salary_id',
        'name',
        'type',
        'amount',
        'percentage',
        'is_active',
        'is_visible',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at',
    ];

    public function Salary(): BelongsTo
    {
        return $this->belongsTo(Salary::class, 'id');
    }

}
