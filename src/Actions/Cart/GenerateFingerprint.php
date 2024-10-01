<?php

namespace Entryshop\Shop\Actions\Cart;

use Entryshop\Shop\Contracts\Cart;
use Entryshop\Utils\Actions\AsAction;

class GenerateFingerprint
{
    use AsAction;

    public function handle(Cart $cart)
    {
        $value = $cart->lines->reduce(fn(?string $carry, $line) => $carry .
            $line->purchasable_type . '_' .
            $line->purchasable_id . '_' .
            $line->quantity . '_' .
            $line->unitPrice . '_' .
            $line->subTotal . '_' .
            $line->total . '_' .
            json_encode($line->getOriginalData()));
        $value .= $cart->shopper_id . $cart->sub_total . $cart->total;
        return sha1($value);
    }
}
