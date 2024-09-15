<?php

namespace Entryshop\Shop\Pipelines\Carts;

use Closure;
use Entryshop\Shop\Contracts\Cart;

class CartCalculator
{
    public function handle(Cart $cart, Closure $next): Cart
    {
        $sub_total = $cart->lines()->sum('total');

        $totals = [
            [
                'name'  => 'Sub total',
                'value' => $sub_total,
            ],
        ];

        $cart->update([
            'totals' => $totals,
            'total'  => $sub_total,
        ]);

        return $next($cart);
    }
}
