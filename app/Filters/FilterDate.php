<?php

namespace App\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\DateFilter;

class FilterDate extends DateFilter
{

    private $column;

    public function __construct($column)
    {
        parent::__construct();
        $this->column = $column;
    }

    /**
     * Modify the current query when the filter is used
     *
     * @param Builder $query Current query
     * @param Carbon $date Carbon instance with the date selected
     * @return Builder Query modified
     */
    public function apply(Builder $query, Carbon $date, $request): Builder
    {
        return $query->whereDate($this->column, $date);
    }
}
