<?php

namespace Entryshop\Shop\Actions\Cart;

use Closure;
use Entryshop\Utils\Actions\AsAction;
use Illuminate\Pipeline\Pipeline;

class CartCalculator
{
    use AsAction;

    public function handle($cart, Closure $next)
    {
        foreach ($cart->lines as $line) {
            app(Pipeline::class)
                ->send($line)
                ->through(
                    config('shop.cart.pipelines.cart_line_calculate', [
                        CartLineCalculator::class,
                    ])
                )->thenReturn();
        }

        $sub_total = $cart->lines->sum('sub_total');

        $cart->totals    = [];
        $cart->sub_total = $sub_total;
        $cart->total     = max(0, $sub_total);
        $cart->quantity  = $cart->lines->sum('quantity');
        return $next($cart);
    }
}
