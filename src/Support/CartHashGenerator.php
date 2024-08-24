<?php

namespace Entryshop\Shop\Support;

use Entryshop\Shop\Contracts\Cart;

class CartHashGenerator implements \Entryshop\Shop\Contracts\CartHashGenerator
{
    public static function generate(Cart $cart): string
    {
        $hash = '';
        foreach ($cart->lines as $line) {
            $hash .= static::getLineHash($line);
        }
        $hash .= '$' . $cart->total . '-' . serialize($cart->getOriginal('data'));
        return static::encode($hash);
    }

    protected static function encode($hash)
    {
        return sha1($hash);
    }

    protected static function getLineHash($line)
    {
        return '#' . $line->id . ':' . $line->product_id . '@' . $line->price . '*' . $line->quantity . '=' . $line->total . '-' . serialize($line->getOriginal('data'));
    }
}
