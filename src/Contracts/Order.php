<?php

namespace Entryshop\Shop\Contracts;

/**
 * @property Cart $cart
 */
interface Order
{
    public function lines();
}
