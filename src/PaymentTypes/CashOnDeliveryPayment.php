<?php

namespace Entryshop\Shop\PaymentTypes;

use Entryshop\Shop\Base\DataTransfer\PaymentAuthorize;
use Entryshop\Shop\Base\DataTransfer\PaymentCapture;
use Entryshop\Shop\Base\DataTransfer\PaymentRefund;
use Entryshop\Shop\Contracts\Transaction;

class CashOnDeliveryPayment extends AbstractPayment
{
    protected $name = 'cash-on-delivery';

    public function authorize(): ?PaymentAuthorize
    {
        if (!$this->order) {
            $this->order = $this->cart->createOrder();
        }

        $this->order->update([
            'payment_status' => 'cash-on-delivery',
        ]);

        return new PaymentAuthorize(
            success: true,
            orderId: $this->order->getKey(),
            paymentType: $this->getName()
        );
    }

    public function refund(Transaction $transaction, int $amount = 0, $notes = null): PaymentRefund
    {
        return new PaymentRefund(true);
    }

    public function capture(Transaction $transaction, $amount = 0): PaymentCapture
    {
        $this->order?->update([
            'payment_status' => 'captured',
        ]);
        return new PaymentCapture(true);
    }
}
