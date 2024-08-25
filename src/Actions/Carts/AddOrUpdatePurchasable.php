<?php

namespace Entryshop\Shop\Actions\Carts;

use Entryshop\Shop\Actions\AbstractAction;
use Entryshop\Shop\Contracts\Cart;
use Entryshop\Shop\Contracts\Purchasable;
use Entryshop\Shop\Exceptions\InvalidCartLineQuantityException;

class AddOrUpdatePurchasable extends AbstractAction
{
    public function execute(
        Cart $cart,
        Purchasable $purchasable,
        int $quantity = 1,
        array $data = []
    ): self {
        throw_if(!$quantity, InvalidCartLineQuantityException::class);

        $existing = app(
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
            return $this;
        }

        $existing = $cart->lines()->create([
            'purchasable_id'   => $purchasable->getKey(),
            'purchasable_type' => $purchasable->getMorphClass(),
            'quantity'         => $quantity,
        ]);

        $existing->update($data);

        return $this;
    }
}
