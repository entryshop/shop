<?php

namespace Entryshop\Shop\Actions\Cart;

use DB;
use Entryshop\Shop\Actions\Order\GenerateNumber;
use Entryshop\Shop\Models\Order;
use Entryshop\Utils\Actions\AsAction;

class CreateOrder
{
    use AsAction;

    public function handle($cart)
    {
        $this->passThrough = DB::transaction(function () use ($cart) {

            if (!empty($cart->order)) {
                return $cart->order;
            }

            $order = Order::create([
                'shopper_id'       => $cart->shopper_id,
                'shopper_type'     => $cart->shopper_type,
                'cart_id'          => $cart->id,
                'sub_total'        => $cart->sub_total,
                'total'            => $cart->total,
                'quantity'         => $cart->quantity,
                'totals'           => $cart->totals,
                'email'            => $cart->shipping_address['email'] ?? '',
                'shipping_address' => $cart->shipping_address,
                'billing_address'  => $cart->billing_address,
                'number'           => GenerateNumber::run(),
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
