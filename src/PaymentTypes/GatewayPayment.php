<?php

namespace Entryshop\Shop\PaymentTypes;

use Entryshop\Shop\Base\DataTransfer\PaymentAuthorize;
use Entryshop\Shop\Base\DataTransfer\PaymentCapture;
use Entryshop\Shop\Contracts\Transaction;

abstract class GatewayPayment extends AbstractPayment
{
    protected $name = 'gateway';

    public function authorize(...$args): ?PaymentAuthorize
    {
        $data = [];
        if (!empty($args[0])) {
            if (is_array($args[0])) {
                $data = $args[0];
            }
            if (is_string($args[0]) && isset($args[1])) {
                $data = [
                    $args[0] => $args[1],
                ];
            }
        }

        $url = $this->pay($data);

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

    public function pay($data = [])
    {
        $transaction = app(Transaction::class)->create(array_merge([
            'payment_type' => $this->getName(),
            'status'       => 'creating',
            'amount'       => $this->cart?->total ?? $this->order?->total,
            'cart_id'      => $this->cart?->getKey(),
            'order_id'     => $this->order?->getKey(),
        ], $data));

        $url = $this->getPayUrl($transaction);

        $transaction->status  = 'pending';
        $transaction->pay_url = $url;
        $transaction->save();

        return $url;
    }
}
