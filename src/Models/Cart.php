<?php

namespace Entryshop\Shop\Models;

use Entryshop\Shop\Actions\Cart\AddOrUpdatePurchasable;
use Entryshop\Shop\Actions\Cart\CartCalculator;
use Entryshop\Shop\Actions\Cart\CreateOrder;
use Entryshop\Shop\Actions\Cart\GenerateFingerprint;
use Entryshop\Shop\Actions\Cart\RemoveCartLine;
use Entryshop\Shop\Actions\Cart\UpdateCartLine;
use Entryshop\Shop\Base\ShopModel;
use Entryshop\Shop\Contracts\Purchasable;
use Entryshop\Shop\Models\Traits\Lockable;
use Entryshop\Utils\Models\Traits\HasReference;
use Entryshop\Utils\Models\Traits\VirtualColumn;
use Illuminate\Pipeline\Pipeline;

class Cart extends ShopModel implements \Entryshop\Shop\Contracts\Cart
{
    use VirtualColumn;
    use Lockable;
    use HasReference;

    public function lines()
    {
        return $this->hasMany(CartLine::class);
    }

    public function add(Purchasable $purchasable, $quantity = 1, $data = [])
    {
        $this->beforeUpdate();
        app(config('shop.cart.actions.add_to_cart', AddOrUpdatePurchasable::class))
            ->run($this, $purchasable, $quantity, $data);
    }

    public function updateLine($line, $quantity, $data = null)
    {
        $this->beforeUpdate();
        $line = $this->findLine($line);
        app(config('shop.cart.actions.update_line', UpdateCartLine::class))
            ->run($line, $quantity, $data);
    }

    public function remove($line)
    {
        $this->beforeUpdate();
        $line = $this->findLine($line);
        app(config('shop.cart.actions.remove_line', RemoveCartLine::class))
            ->run($line);
    }

    protected function findLine($line)
    {
        if ($line instanceof CartLine) {
            $line = $line->id;
        }
        return $this->lines()->findOrFail($line);
    }

    public function calculate()
    {
        $cart = app(Pipeline::class)
            ->send($this)
            ->through(
                config('shop.cart.pipelines.cart_calculate', [
                    CartCalculator::class,
                ])
            )->thenReturn();
        $hash = GenerateFingerprint::run($cart);
        $cart->update([
            'hash' => $hash,
        ]);
        return $cart;
    }

    public function createOrder($data = [])
    {
        $cart = $this->calculate();
        return app(
            config('shop.cart.actions.create_order', CreateOrder::class)
        )
            ->run($cart)
            ->then(fn($order) => $order->refresh());
    }
}
