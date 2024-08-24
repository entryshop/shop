<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Contracts\Cart as CartContract;
use Entryshop\Shop\Contracts\CartCalculator;
use Entryshop\Shop\Contracts\CartHashGenerator;
use Entryshop\Shop\Contracts\CartValidator;
use Entryshop\Shop\Contracts\Order;
use Entryshop\Shop\Contracts\OrderGenerator;
use Entryshop\Shop\Contracts\Purchasable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Cart extends Model implements CartContract
{
    use VirtualColumn;

    protected $guarded = [];
    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function lines()
    {
        return $this->hasMany(Line::class);
    }

    public function shopper(): MorphTo
    {
        return $this->morphTo('shopper');
    }

    public function createOrder(...$args): Order
    {
        return app(OrderGenerator::class)->generate($this, ...$args);
    }

    public function add(Purchasable $product, $quantity = 1)
    {
        return $this->lines()->create([
            'product_id' => $product->getKey(),
            'price'      => $product->getPrice(),
            'quantity'   => $quantity,
        ]);
    }

    public function calculate()
    {
        $cart = app(CartCalculator::class)->calculate($this);
        $hash = app(CartHashGenerator::class)->generate($cart);
        $cart->update([
            'hash' => $hash,
        ]);
        return $cart;
    }

    public function validate()
    {
        $validator = app(CartValidator::class);
        return $validator->validate($this);
    }

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'shopper_type',
            'shopper_id',
            'session_id',
            'status',
            'total',
            'hash',
            'active',
            'created_at',
            'updated_at',
            'order',
            'lines',
            'shopper',
        ];
    }
}
