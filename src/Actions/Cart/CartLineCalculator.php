<?php

namespace Entryshop\Shop\Actions\Cart;

use Closure;
use Entryshop\Utils\Actions\AsAction;

class CartLineCalculator
{
    use AsAction;

    public function handle($line, Closure $next)
    {
        $line->price     = $line->purchasable->getPrice();
        $line->sub_total = $line->price * $line->quantity;
        $line->total     = $line->sub_total;
        return $next($line);
    }
}
