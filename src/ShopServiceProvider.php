<?php

namespace Entryshop\Shop;

use Entryshop\Shop\Console\Commands\ImportCountries;
use Entryshop\Shop\Contracts\CartService;
use Entryshop\Shop\Contracts\PaymentService;
use Entryshop\Shop\Contracts\Product;
use Entryshop\Shop\Observers\ProductObserver;
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
        $this->registerObservers();

        $this->commands([
            ImportCountries::class,
        ]);
    }

    protected function registerObservers(): void
    {
        app(resolve_class(Product::class))::observe(ProductObserver::class);
    }

}
