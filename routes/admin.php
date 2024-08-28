<?php

use Entryshop\Shop\Http\Controllers\Admin;

admin()->routeGroup(function () {
    Route::crud('orders', Admin\OrderController::class);
    Route::crud('products', Admin\ProductController::class);
});
