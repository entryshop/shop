<?php

namespace Entryshop\Shop\Actions\Cart;

use DB;
use Entryshop\Shop\Exceptions\ShopException;
use Entryshop\Shop\Models\Order;
use Entryshop\Utils\Actions\AsAction;

class CreateOrder
{
    use AsAction;

    public function handle($cart)
    {
        $this->passThrough = DB::transaction(function () use ($cart) {

            if (!empty($cart->order_id)) {
                throw new ShopException('Cart already has an order');
            }

            $order = Order::create([
                'shopper_id'   => $cart->shopper_id,
                'shopper_type' => $cart->shopper_type,
                'cart_id'      => $cart->id,
                'total'        => $cart->total,
                'quantity'     => $cart->quantity,
                'sub_total'    => $cart->sub_total,
                'totals'       => $cart->totals,
            ]);

            $order->setData($cart->getOriginalData());

            foreach ($cart->lines as $cart_line) {
                $order_line = $order->lines()->create([
                    'purchasable_type' => $cart_line->purchasable_type,
                    'purchasable_id'   => $cart_line->purchasable_id,
                    'name'             => $cart_line->purchasable->getName(),
                    'sku'              => $cart_line->purchasable->getSku(),
                    'image'            => $cart_line->purchasable->getImage(),
                    'quantity'         => $cart_line->quantity,
                    'price'            => $cart_line->price,
                    'total'            => $cart_line->total,
                ]);
                $order_line->setData($cart_line->getOriginalData());
            }
            $cart->update([
                'order_id' => $order->id,
                'active'   => false,
            ]);
            return $order;
        });

        return $this;
    }
}
