<?php

use Entryshop\Shop\Contracts\CartService;

/**
 * @return CartService
 */
function cart()
{
    return app(CartService::class);
}
