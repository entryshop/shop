<?php

namespace Entryshop\Shop\Actions\Carts;

use Entryshop\Shop\Actions\AbstractAction;
use Entryshop\Shop\Contracts\Cart;
use Entryshop\Shop\Contracts\Order;

class CreateOrder extends AbstractAction
{
    public static function execute(Cart $cart, ...$args)
    {
        $order = app(Order::class)->create([
            'cart_id'      => $cart->getKey(),
            'total'        => $cart->total,
            'shopper_type' => $cart->shopper_type,
            'shopper_id'   => $cart->shopper_id,
            'currency'     => $cart->currency,
            'number'       => 1000 + app(Order::class)->count(),
        ]);

        if ($cart->shopper) {
            $order->shopper()->associate($cart->shopper);
            $order->save();
        }

        foreach ($cart->lines as $line) {
            $line->update([
                'order_id' => $order->id,
            ]);
        }

        $cart->update(['active' => false]);
        return $order;
    }

}
