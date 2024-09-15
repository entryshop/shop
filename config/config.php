<?php

use Entryshop\Shop;
use Entryshop\Shop\Actions;
use Entryshop\Shop\Pipelines;

return [
    'bindings'                  => [
        Shop\Contracts\CartService::class    => Shop\Services\CartService::class,
        Shop\Contracts\PaymentService::class => Shop\Services\PaymentService::class,
        Shop\Contracts\Cart::class           => Shop\Models\Cart::class,
        Shop\Contracts\Order::class          => Shop\Models\Order::class,
        Shop\Contracts\Line::class           => Shop\Models\Line::class,
        Shop\Contracts\Product::class        => Shop\Models\Product::class,
        Shop\Contracts\ProductVariant::class => Shop\Models\ProductVariant::class,
        Shop\Contracts\Transaction::class    => Shop\Models\Transaction::class,
    ],
    'database'                  => [
        'prefix' => 'shop_',
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
        'add_to_cart'            => Actions\Carts\AddOrUpdatePurchasable::class,
        'remove_from_cart'       => Actions\Carts\DeleteCartLine::class,
        'create_order'           => Actions\Carts\CreateOrder::class,
        'get_existing_cart_line' => Actions\Carts\GetExistingCartLine::class,
        'hash_generate'          => Actions\Carts\CartHashGenerator::class,
    ],
    'pipelines'                 => [
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
