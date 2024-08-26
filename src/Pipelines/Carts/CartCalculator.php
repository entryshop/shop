<?php

namespace Entryshop\Shop\Pipelines\Carts;

use Closure;
use Entryshop\Shop\Contracts\Cart;

class CartCalculator
{
    public static function handle(Cart $cart, Closure $next): Cart
    {
        $cart->total = $cart->lines()->sum('total');
        return $next($cart);
    }
}
