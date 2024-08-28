<?php

use Entryshop\Shop\Http\Controllers\Admin\OrderController;

admin()->routeGroup(function () {
    Route::crud('orders', OrderController::class);
});
