<?php

namespace Entryshop\Shop;

use Entryshop\Shop\Contracts\CartService;
use Entryshop\Shop\Contracts\PaymentService;
use Illuminate\Support\ServiceProvider;

class ShopServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'shop');

        $bindings = config('shop.bindings');

        foreach ($bindings as $contact => $implementation) {
            $this->app->bind($contact, $implementation);
        }

        $this->app->scoped('cart', function () {
            return app(CartService::class);
        });

        $this->app->scoped('payments', function ($app) {
            return $app->make(PaymentService::class);
        });
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
