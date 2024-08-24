<?php

namespace Entryshop\Shop\Contracts;

/**
 * @property array lines
 * @property numeric total
 */
interface Cart
{
    public function createOrder(): Order;
}
