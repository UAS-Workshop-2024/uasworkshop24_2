<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class OutOfStockException extends Exception
{
    public function report()
	{
		Log::debug('The product is out of stock');
	}
}
