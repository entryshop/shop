<?php

namespace Entryshop\Shop\Pipelines\Carts;

use Closure;
use Entryshop\Shop\Contracts\Cart;

class CartCalculator
{
    public static function handle(Cart $cart, Closure $next): Cart
    {
        $totals = [
            'name'  => 'Sub total',
            'value' => $cart->lines()->sum('total'),
        ];

        $cart->update([
            'totals' => $totals,
        ]);

        return $next($cart);
    }
}
