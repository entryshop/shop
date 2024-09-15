<?php

namespace Entryshop\Shop\Pipelines\Carts;

use Closure;
use Entryshop\Shop\Contracts\Cart;

class LineCalculator
{
    public function handle(Cart $cart, Closure $next): Cart
    {
        foreach ($cart->lines as $line) {
            $price = $line->purchasable->price;
            $total = $price * $line->quantity;
            $line->update([
                'price' => $price,
                'total' => $total,
                'name'  => $line->purchasable?->name ?? '',
                'image' => $line->purchasable?->image ?? '',
            ]);
        }
        return $next($cart);
    }
}
