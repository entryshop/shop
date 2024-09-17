<?php

namespace Entryshop\Shop\PaymentTypes;

use Entryshop\Shop\Base\AbstractPaymentType;

abstract class GatewayPayment extends AbstractPaymentType
{
    protected $name = 'gateway';

    abstract public function getPayUrl();
}
