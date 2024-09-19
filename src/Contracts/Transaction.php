<?php

namespace Entryshop\Shop\Contracts;

use Entryshop\Shop\Models\Order;

/**
 * @property ?Cart $cart
 * @property ?Order $order
 * @property float $amount
 * @property string $reference
 */
interface Transaction
{
    public function getPaymentDriver();

    public function getStatus();

    public function setStatus($status);

}
