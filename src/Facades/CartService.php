<?php

namespace Entryshop\Shop\Facades;

use Entryshop\Shop\Services\CartService as BaseService;
use Illuminate\Support\Facades\Facade;

/**
 * @mixin BaseService
 */
class CartService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cart';
    }
}
