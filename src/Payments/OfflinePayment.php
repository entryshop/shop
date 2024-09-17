<?php

namespace Entryshop\Shop\Payments;

use Entryshop\Shop\Base\AbstractPaymentType;
use Entryshop\Shop\Events\Transaction\Captured;

class OfflinePayment extends AbstractPaymentType
{
    public function authorize()
    {
        dump('authorize by cod');
    }

    public function capture($amount = null)
    {
        $this->transaction->setStatus('captured');
        Captured::dispatch($this->transaction);
    }

    public function refund($amount = null)
    {
        dump('refund:' . $amount);
    }
}
