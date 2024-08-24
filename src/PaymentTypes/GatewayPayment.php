<?php

namespace Entryshop\Shop\PaymentTypes;

use Entryshop\Shop\Base\DataTransfer\PaymentAuthorize;
use Entryshop\Shop\Base\DataTransfer\PaymentCapture;
use Entryshop\Shop\Contracts\Transaction;

abstract class GatewayPayment extends AbstractPayment
{
    protected $name = 'gateway';

    public function authorize(): ?PaymentAuthorize
    {
        $url = $this->pay();

        return new PaymentAuthorize(
            redirectUrl: $url,
        );
    }

    public function capture(Transaction $transaction): ?PaymentCapture
    {

        $transaction->update([
            'status' => 'paid',
        ]);

        if ($transaction->cart) {
            if (empty($transaction->order)) {
                $order = $transaction->cart->createOrder();
                $transaction->update([
                    'order_id' => $order->getKey(),
                ]);
                $transaction->refresh();
            }
        }

        $transaction->order?->update([
            'payment_status' => 'paid',
        ]);

        return new PaymentCapture(true);
    }

    public function pay()
    {
        $transaction = app(Transaction::class)->create([
            'payment_type' => $this->getName(),
            'status'       => 'creating',
            'amount'       => $this->cart?->total ?? $this->order?->total,
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
