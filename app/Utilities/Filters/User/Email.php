<?php

namespace App\Utilities\Filters\User;

use App\Utilities\Filters\FilterContract;

class Email implements FilterContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($value = ""): void
    {
        if (! empty($value)) {
            $this->query->where('email', 'ILIKE', "%{$value}%");
        }
    }
}
