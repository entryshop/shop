<?php

namespace Entryshop\Shop\Actions\Carts;

use Entryshop\Shop\Actions\AbstractAction;
use Entryshop\Shop\Contracts\Cart;
use Entryshop\Shop\Contracts\Line;
use Entryshop\Shop\Contracts\Purchasable;
use Entryshop\Shop\Exceptions\InvalidCartLineQuantityException;
use Exception;

class AddOrUpdatePurchasable extends AbstractAction
{
    public function execute(
        Cart $cart,
        $LineOrPurchasable = null,
        int $quantity = 1,
        array $data = []
    ): self {
        throw_if(!$quantity, InvalidCartLineQuantityException::class);

        if ($LineOrPurchasable instanceof Line) {
            $existing = $LineOrPurchasable;
            $existing->update([
                'quantity' => $quantity,
            ]);
        } elseif ($LineOrPurchasable instanceof Purchasable) {
            $purchasable = $LineOrPurchasable;
            $existing    = app(
                config('shop.actions.get_existing_cart_line', GetExistingCartLine::class)
            )->execute(
                cart: $cart,
                purchasable: $purchasable,
                data: $data
            );
            if ($existing) {
                $existing->update([
                    'quantity' => $existing->quantity + $quantity,
                ]);
            } else {
                $existing = $cart->lines()->create([
                    'purchasable_id'   => $purchasable->getKey(),
                    'purchasable_type' => $purchasable->getMorphClass(),
                    'quantity'         => $quantity,
                ]);
            }
        } else {
            throw new Exception('Invalid LineOrPurchasable');
        }
        $existing->update($data);
        return $this;
    }
}
