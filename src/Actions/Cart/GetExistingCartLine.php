<?php

namespace Entryshop\Shop\Actions\Cart;

use Entryshop\Utils\Actions\AsAction;
use Entryshop\Utils\Support\Arr;

class GetExistingCartLine
{
    use AsAction;

    public function handle($cart, $purchasable, $data = null)
    {
        $lines = $cart->lines()
            ->wherePurchasableType(
                $purchasable->getMorphClass()
            )
            ->wherePurchasableId($purchasable->getKey())
            ->get();

        return $lines->first(function ($line) use ($data) {
            return Arr::isSame($line->getOriginalData(), $data);
        });
    }
}
