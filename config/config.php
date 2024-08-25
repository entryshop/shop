<?php

use Entryshop\Shop;
use Entryshop\Shop\Pipelines\Carts\CartCalculator;

return [
    'bindings' => [
        Shop\Contracts\CartService::class    => Shop\Services\CartService::class,
        Shop\Contracts\PaymentService::class => Shop\Services\PaymentService::class,
        Shop\Contracts\Cart::class           => Shop\Models\Cart::class,
        Shop\Contracts\Order::class          => Shop\Models\Order::class,
        Shop\Contracts\Transaction::class    => Shop\Models\Transaction::class,
        Shop\Contracts\Line::class           => Shop\Models\Line::class,
        Shop\Contracts\OrderGenerator::class => Shop\Support\OrderGenerator::class,
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

    'actions' => [
        'add_to_cart'            => Shop\Actions\Carts\AddOrUpdatePurchasable::class,
        'get_existing_cart_line' => Shop\Actions\Carts\GetExistingCartLine::class,
        'hash_generate'          => Shop\Actions\Carts\CartHashGenerator::class,
    ],

    'pipelines' => [
        'cart_calculate' => [
            CartCalculator::class,
        ],
        'cart_validate'  => [
            Shop\Pipelines\Carts\CartValidator::class,
        ],
    ],
];
