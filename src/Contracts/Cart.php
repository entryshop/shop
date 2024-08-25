<?php

namespace Entryshop\Shop\Contracts;

/**
 * @property array lines
 * @property integer total
 * @property string hash
 * @property ?Order order
 * @property ?Shopper shopper
 */
interface Cart
{
    public function createOrder();

    public function calculate();

    public function validate($throw = true);
}
