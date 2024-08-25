<?php

namespace Entryshop\Shop\Pipelines\Carts;

use Closure;
use Entryshop\Shop\Exceptions\InvalidCartTotalException;

class CartValidator
{
    public static function handle($data, Closure $next)
    {
        $cart  = $data['cart'];
        $throw = $data['throw'];

        if ($cart->total <= 0) {
            if ($throw) {
                throw new InvalidCartTotalException('Cart total must be greater than 0');
            }
            $errors          = $data['errors'];
            $errors['total'] = 'Cart total must be greater than 0';
            $data['errors']  = $errors;
        }
        return $next($data);
    }
}
