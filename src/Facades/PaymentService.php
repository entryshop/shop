<?php

namespace Entryshop\Shop\Facades;

use Entryshop\Shop\PaymentTypes\AbstractPayment;
use Illuminate\Support\Facades\Facade;

/**
 * @method AbstractPayment driver($payment_type = null)
 * @method void extend($payment_type, $payment_class) add new payment type
 */
class PaymentService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'payments';
    }
}
