<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

class SelectionFilter extends Filter
{
    private string $column_name;
    private array $selection_list;

    public $title =  "custom";

    public function __construct($title, $column_name, $selection_list)
    {
        parent::__construct();
        $this->title = $title;
        $this->column_name = $column_name;
        $this->selection_list = $selection_list;
    }

    /**
     * Modify the current query when the filter is used
     *
     * @param Builder $query Current query
     * @param $value string selected by the user
     * @return Builder Query modified
     */
    public function apply(Builder $query, $value, $request): Builder
    {
        return $query->where($this->column_name, $value);
    }

    /**
     * Defines the title and value for each option
     *
     * @return array associative array with the title and values
     */
    public function options(): array
    {
        return $this->selection_list;
    }
}
