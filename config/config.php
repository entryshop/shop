<?php

use Entryshop\Shop;

return [
    'bindings' => [
        Shop\Contracts\CartService::class       => Shop\Services\CartService::class,
        Shop\Contracts\Cart::class              => Shop\Models\Cart::class,
        Shop\Contracts\PaymentService::class    => Shop\Services\PaymentService::class,
        Shop\Contracts\Order::class             => Shop\Models\Order::class,
        Shop\Contracts\Transaction::class       => Shop\Models\Transaction::class,
        Shop\Contracts\CartHashGenerator::class => Shop\Support\CartHashGenerator::class,
        Shop\Contracts\CartCalculator::class    => Shop\Support\CartCalculator::class,
    ],
    'cart'     => [
        'session_key' => 'entryshop_cart',
        'auto_create' => false,
    ],
    'payments' => [
        'default' => env('PAYMENTS_TYPE', 'cash-on-delivery'),
        'types'   => [
            'cash-on-delivery' => Shop\PaymentTypes\CashOnDeliveryPayment::class,
        ],
    ],
];
