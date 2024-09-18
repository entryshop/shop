<?php

use Entryshop\Shop\Contracts;
use Entryshop\Shop\Models;

return [
    'database' => [
        'prefix' => 'shop_',
    ],
    'bindings' => [
        Contracts\Cart::class        => Models\Cart::class,
        Contracts\Order::class       => Models\Order::class,
        Contracts\Transaction::class => Models\Transaction::class,
    ],
];
