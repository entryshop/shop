<?php

namespace Entryshop\Shop\Contracts;

interface OrderGenerator
{
    public static function generate(Cart $cart, ...$args): Order;
}
