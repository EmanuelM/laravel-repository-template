<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Utilities\Filters\FilterBuilder;

trait Filtered
{
    protected $filtersNamespace = "App\Utilities\Filters";

    /**
     * Filter by classes
     *
     * @param  Builder      $query
     * @param  array|null   $filters
     * @return Builder
     */
    public function scopeFilterBy($query, ?array $filters = []): Builder
    {
        if (is_array($filters) && count($filters) > 0) {
            $namespace = $this->filtersNamespace . "\\" . class_basename($this);
            $filter = new FilterBuilder($query, $filters, $namespace);

            return $filter->apply();
        }

        return $query;
    }
}
