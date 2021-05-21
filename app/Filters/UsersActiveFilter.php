<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;
use Ramsey\Uuid\Type\Integer;

class UsersActiveFilter extends Filter
{
    /**
     * Modify the current query when the filter is used
     *
     * @param Builder $query Current query
     * @param $value Integer selected by the user
     * @return Builder Query modified
     */
    public function apply(Builder $query, $value, $request): Builder
    {
        return $query->where('is_active', $value);
    }

    /**
     * Defines the title and value for each option
     *
     * @return array associative array with the title and values
     */
    public function options(): array
    {
        return [
            'Active' => 0,
            'Disabled' => 1
        ];
    }
}
