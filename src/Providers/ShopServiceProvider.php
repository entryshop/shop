<?php

namespace Entryshop\Shop\Providers;

use Entryshop\Shop\Managers\PaymentManager;
use Entryshop\Shop\Services\CartService;
use Illuminate\Support\ServiceProvider;

class ShopServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/shop.php', 'shop');
        $this->mergeConfigFrom(__DIR__ . '/../../config/payments.php', 'shop.payments');
        $this->mergeConfigFrom(__DIR__ . '/../../config/cart.php', 'shop.cart');

        $bindings = config('shop.bindings');
        foreach ($bindings as $contact => $implementation) {
            $this->app->bind($contact, $implementation);
        }

        $this->app->scoped('payments', PaymentManager::class);
        $this->app->scoped('carts', CartService::class);
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        }
    }
}
