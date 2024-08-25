<?php

namespace Entryshop\Shop\Pipelines\Carts;

use Closure;

class CartValidator
{
    public static function handle($data, Closure $next)
    {
        $cart   = $data[0];
        $errors = $data[1];

        if ($cart->total <= 0) {
            $errors['total'] = 'Cart total must be greater than 0';
        }

        return $next([$cart, $errors]);
    }
}
