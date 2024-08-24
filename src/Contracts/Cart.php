<?php

namespace Entryshop\Shop\Contracts;

/**
 * @property array lines
 * @property numeric total
 * @property ?Order order
 */
interface Cart
{
    public function createOrder(): Order;

    public function calculate();

    public function validate();
}
