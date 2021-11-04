<?php

namespace App\Utilities\Orders;

interface OrderContract
{
	public function handle($value): void;
}