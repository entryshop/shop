<?php

namespace Entryshop\Shop\PaymentTypes;

use Entryshop\Shop\Base\DataTransfer\PaymentAuthorize;
use Entryshop\Shop\Base\DataTransfer\PaymentCapture;
use Entryshop\Shop\Base\DataTransfer\PaymentRefund;

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
            orderId: $this->order?->getKey(),
            cartId: $this->cart?->getKey(),
            paymentType: $this->getName()
        );
    }

    public function refund(): PaymentRefund
    {
        return new PaymentRefund(true);
    }

    public function capture(): PaymentCapture
    {
        $this->order?->update([
            'payment_status' => 'captured',
        ]);
        return new PaymentCapture(true);
    }
}
