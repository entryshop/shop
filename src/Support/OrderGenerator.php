<?php

namespace Entryshop\Shop\Support;

use Entryshop\Shop\Contracts\Cart;
use Entryshop\Shop\Contracts\Order;

class OrderGenerator implements \Entryshop\Shop\Contracts\OrderGenerator
{
    public static function generate(Cart $cart, ...$args): Order
    {
        $order = app(Order::class)->create([
            'cart_id' => $cart->getKey(),
            'total'   => $cart->total,
            'number'  => 1000 + app(Order::class)->count(),
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
