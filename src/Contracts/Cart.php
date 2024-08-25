<?php

namespace Entryshop\Shop\Contracts;

/**
 * @property array lines
 * @property numeric total
 * @property ?Order order
 */
interface Cart
{
    public function createOrder();

    public function calculate();

    public function validate();
}
