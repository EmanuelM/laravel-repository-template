<?php

namespace App\Utilities\Orders;

class OrderBuilder
{

    public function __construct(
        protected $query,
        protected $request,
        protected string $namespace,
        protected string $orderType = "ASC",
    ) {}

    public function apply()
    {
        if (isset($this->request['order_by'])) {
            if (isset($this->request['order_type']) && in_array(strtoupper($this->request['order_type']), ["ASC", "DESC"]))
            {
                $this->orderType = $this->request['order_type'];
            }

            $normailizedName = ucfirst($this->request['order_by']);
            $class = $this->namespace . "\\{$normailizedName}";

            if (class_exists($class)) {
                (new $class($this->query))->handle($this->orderType);
            }
        }

        return $this->query;
    }
}