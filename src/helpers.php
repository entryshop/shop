<?php

use Entryshop\Shop\Contracts\CartService;

/**
 * @return CartService
 */
if (!function_exists('cart')) {
    function cart()
    {
        return app(CartService::class);
    }
}

/**
 * return implementation class
 */
if (!function_exists('resolve_class')) {
    function resolve_class($contact_class)
    {
        return get_class(resolve($contact_class));
    }
}
