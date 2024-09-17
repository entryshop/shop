<?php

namespace Entryshop\Shop\Facades;

use Entryshop\Shop\Managers\PaymentManager;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin PaymentManager
 */
class Payments extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'payments';
    }
}
