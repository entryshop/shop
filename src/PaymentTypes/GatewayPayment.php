<?php

namespace Entryshop\Shop\PaymentTypes;

use Entryshop\Shop\Contracts\Transaction;

abstract class GatewayPayment extends AbstractPayment
{
    protected $name = 'gateway';

    public function pay()
    {
        $transaction = app(Transaction::class)->create([
            'payment_type' => $this->getName(),
            'status'       => 'creating',
            'amount'       => $this->cart?->total(),
            'cart_id'      => $this->cart?->getKey(),
            'order_id'     => $this->order?->getKey(),
        ]);

        $url = $this->getPayUrl($transaction);

        $transaction->amopay_url = $url;
        $transaction->status     = 'pending';
        $transaction->save();
        return $url;
    }
}
