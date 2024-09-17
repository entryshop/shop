<?php

return [

    'defaults' => [
        'type' => env('PAYMENT_DEFAULT_TYPE', 'cash-on-hand'),
    ],
    'types'    => [
        'cash-on-hand' => [
            'driver'     => 'offline',
            'authorized' => 'pay-offline',
        ],
    ],
];
