<?php

use Entryshop\Shop\Actions;

return [
    'actions'   => [
        'add_to_cart'  => Actions\Cart\AddOrUpdatePurchasable::class,
        'update_line'  => Actions\Cart\UpdateCartLine::class,
        'remove_line'  => Actions\Cart\RemoveCartLine::class,
        'create_order' => Actions\Cart\CreateOrder::class,
    ],
    'pipelines' => [
        'cart_calculate'      => [
            Actions\Cart\CartCalculator::class,
        ],
        'cart_line_calculate' => [
            Actions\Cart\CartLineCalculator::class,
        ],
    ],
];
