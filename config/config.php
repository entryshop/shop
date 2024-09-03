<?php

use Entryshop\Shop;
use Entryshop\Shop\Pipelines;

return [
    'admin'    => [
        'enable'        => true,
        'register_menu' => true,
    ],
    'bindings' => [
        Shop\Contracts\CartService::class    => Shop\Services\CartService::class,
        Shop\Contracts\PaymentService::class => Shop\Services\PaymentService::class,
        Shop\Contracts\Cart::class           => Shop\Models\Cart::class,
        Shop\Contracts\Order::class          => Shop\Models\Order::class,
        Shop\Contracts\Transaction::class    => Shop\Models\Transaction::class,
        Shop\Contracts\Line::class           => Shop\Models\Line::class,
        Shop\Contracts\Product::class        => Shop\Models\Product::class,
        Shop\Contracts\ProductVariant::class => Shop\Models\ProductVariant::class,
        Shop\Contracts\Price::class          => Shop\Support\Price::class,
    ],
    'default_currency'          => 'USD',
    'default_currency_decimals' => 0,
    'cart'                      => [
        'session_key' => 'entryshop_cart',
        'auto_create' => false,
    ],
    'payments'                  => [
        'default' => env('PAYMENTS_TYPE', 'cash-on-delivery'),
        'types'   => [
            'cash-on-delivery' => Shop\PaymentTypes\CashOnDeliveryPayment::class,
        ],
    ],
    'actions'                   => [
        'add_to_cart'            => Shop\Actions\Carts\AddOrUpdatePurchasable::class,
        'create_order'           => Shop\Actions\Carts\CreateOrder::class,
        'get_existing_cart_line' => Shop\Actions\Carts\GetExistingCartLine::class,
        'hash_generate'          => Shop\Actions\Carts\CartHashGenerator::class,
    ],
    'pipelines' => [
        'cart_calculate' => [
            Pipelines\Carts\LineCalculator::class,
            Pipelines\Carts\CartCalculator::class,
        ],
        'cart_validate'  => [
            Pipelines\Carts\CartValidator::class,
        ],
        'order_created'  => [
            Pipelines\Orders\UpdateOrderFulfillmentStatus::class,
        ],
    ],
];
