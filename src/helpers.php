<?php

use Entryshop\Shop\Contracts\CartService;
use Illuminate\Pipeline\Pipeline;

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

if (!function_exists('pipeline')) {
    function pipeline($passable, $through = [])
    {
        return app(Pipeline::class)->send($passable)->through($through);
    }
}
