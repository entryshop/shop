<?php

namespace Entryshop\Shop\Payments;

use Entryshop\Shop\Base\AbstractPaymentType;

abstract class GatewayPayment extends AbstractPaymentType
{
    abstract public function getPayUrl();
}
