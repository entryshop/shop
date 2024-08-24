<?php

namespace Entryshop\Shop\Support;

use Entryshop\Shop\Contracts\Cart;

class CartValidator implements \Entryshop\Shop\Contracts\CartValidator
{
    public static function validate(Cart $cart): bool|array
    {
        if ($cart->total <= 0) {
            return [
                'total' => 'Cart total must be greater than 0',
            ];
        }
        return true;
    }
}
