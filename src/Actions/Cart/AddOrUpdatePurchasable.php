<?php

namespace Entryshop\Shop\Actions\Cart;

use Entryshop\Utils\Actions\AsAction;

class AddOrUpdatePurchasable
{
    use AsAction;

    public function handle($cart, $purchasable, $quantity, $data = null)
    {
        $existing = GetExistingCartLine::run($cart, $purchasable, $data);

        if (empty($existing)) {
            $existing = $cart->lines()->create([
                'purchasable_type' => $purchasable->getMorphClass(),
                'purchasable_id'   => $purchasable->getKey(),
                'quantity'         => $quantity,
            ]);
            $existing->setData($data);
        } else {
            $existing->increment('quantity', $quantity);
        }

        return $existing;
    }
}
