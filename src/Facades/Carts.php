<?php

namespace Entryshop\Shop\Facades;

use Entryshop\Shop\Services\CartService;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin CartService
 */
class Carts extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'carts';
    }
}
