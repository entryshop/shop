<?php

namespace Entryshop\Shop;

use Entryshop\Shop\Console\Commands\ImportCountries;
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

        $this->app->scoped('cart', function ($app) {
            return $app->make(CartService::class);
        });

        $this->app->scoped('payments', function ($app) {
            return $app->make(PaymentService::class);
        });
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'shop');

        if ($this->app->runningInConsole()) {
            $this->registerCommands();
        }
        $this->registerObservers();
    }

    protected function registerCommands(): void
    {
        $this->commands([
            ImportCountries::class,
        ]);
    }

    protected function registerObservers(): void
    {
    }
}
