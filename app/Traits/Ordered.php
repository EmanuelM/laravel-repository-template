<?php

namespace App\Traits;

use App\Utilities\Orders\OrderBuilder;
use Illuminate\Database\Eloquent\Builder;

trait Ordered
{
    protected $ordersNamespace = "App\Utilities\Orders";

    /**
     * Order by classes
     *
     * @param  Builder      $query
     * @param  array|null   $filters
     * @return Builder
     */
    public function scopeOrderedBy($query, ?array $filters = NULL): Builder
    {
        if (is_array($filters) && isset($filters['order_by'])) {
            $namespace = $this->ordersNamespace . "\\" . class_basename($this);
            $filter = new OrderBuilder($query, $filters, $namespace);

            return $filter->apply();
        }

        return $query;
    }
}
