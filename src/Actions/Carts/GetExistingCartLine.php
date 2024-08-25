<?php

namespace Entryshop\Shop\Actions\Carts;

use Entryshop\Shop\Actions\AbstractAction;
use Entryshop\Shop\Contracts\Cart;
use Entryshop\Shop\Contracts\Purchasable;
use Entryshop\Shop\Models\Line;

class GetExistingCartLine extends AbstractAction
{
    public function execute(
        Cart $cart,
        Purchasable $purchasable,
        array $data = []
    ): ?Line {
        // Get all possible cart lines
        $lines = $cart->lines()
            ->wherePurchasableType(
                $purchasable->getMorphClass()
            )->wherePurchasableId($purchasable->getKey())
            ->get();

        return $lines->first(function ($line) use ($data) {
            $original_data = $line->getOriginalData();
            return empty(array_diff_assoc($data, $original_data));
        });
    }
}
