<?php

namespace Entryshop\Shop\Facades;

use Illuminate\Support\Facades\Facade;

class PaymentService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'payments';
    }
}
