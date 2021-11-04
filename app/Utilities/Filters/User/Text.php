<?php

namespace App\Utilities\Filters\Account;

use App\Utilities\Filters\FilterContract;

class Text implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value = ""): void
    {
        if (! empty($value)) {
            $this->query->where(function ($query) use ($value) {
                $query
                    ->where('name', 'ILIKE', "%{$value}%")
                    ->orWhere('email', 'ILIKE', "%{$value}%");
            });
        }
    }
}