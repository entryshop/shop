<?php

namespace Entryshop\Shop\Actions\Carts;

use Entryshop\Shop\Actions\AbstractAction;
use Entryshop\Shop\Contracts\Cart;

class CartHashGenerator extends AbstractAction
{
    public static function execute(Cart $cart)
    {
        $hash = '';
        foreach ($cart->lines as $line) {
            $hash .= static::getLineHash($line);
        }
        $hash .= '$' . $cart->total . '-' . serialize($cart->getOriginalData());
        return static::encode($hash);
    }

    protected static function encode($hash)
    {
        return sha1($hash);
    }

    protected static function getLineHash($line)
    {
        return '#' . $line->id . ':' . $line->product_id . '@' . $line->price . '*' . $line->quantity . '=' . $line->total . '-' . serialize($line->getOriginalData());
    }
}
