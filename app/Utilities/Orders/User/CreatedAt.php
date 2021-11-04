<?php

namespace App\Utilities\Orders\User;

use App\Utilities\Orders\OrderContract;

class CreatedAt implements OrderContract
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function handle($orderType = "ASC"): void
    {
        $this->query->orderBy('created_at', $orderType);
    }
}