<?php

namespace App\Utilities\Filters;
use Carbon\Carbon;

class FilterBuilder
{
    public function __construct(
        protected $query,
        protected $filters,
        protected string $namespace
    ) {}

    public function apply()
    {
        foreach ($this->filters as $name => $value) {
            $normailizedName = ucfirst($name);
            $class = $this->namespace . "\\{$normailizedName}";

            if (!class_exists($class)) continue;

            if (is_string($value) || is_numeric($value) || is_array($value) || $value instanceof Carbon) {
                (new $class($this->query))->handle($value);
            } else {
                (new $class($this->query))->handle();
            }
        }

        return $this->query;
    }
}