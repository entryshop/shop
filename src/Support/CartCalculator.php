<?php

namespace Entryshop\Shop\Support;

use Entryshop\Shop\Contracts\Cart;

class CartCalculator implements \Entryshop\Shop\Contracts\CartCalculator
{
    public static function calculate(Cart $cart): Cart
    {
        foreach ($cart->lines as $line) {
            $price = $line->product->price;
            $total = $price * $line->quantity;
            $line->update([
                'price' => $price,
                'total' => $total,
            ]);
        }
        $cart->total = $cart->lines()->sum('total');
        $cart->save();
        return $cart;
    }
}
