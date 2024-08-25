<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Actions\Carts\AddOrUpdatePurchasable;
use Entryshop\Shop\Contracts;
use Entryshop\Shop\Contracts\Cart as CartContract;
use Entryshop\Shop\Contracts\CartCalculator;
use Entryshop\Shop\Contracts\CartHashGenerator;
use Entryshop\Shop\Contracts\CartValidator;
use Entryshop\Shop\Contracts\OrderGenerator;
use Entryshop\Shop\Contracts\Purchasable;
use Entryshop\Shop\Models\Traits\HasReference;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Cart extends Model implements CartContract
{
    use VirtualColumn;
    use HasReference;

    protected static $reference_prefix = 'cart_';

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
        return $this->hasMany(get_class(resolve(Contracts\Line::class)));
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(get_class(resolve(Contracts\Order::class)));
    }

    public function shopper(): MorphTo
    {
        return $this->morphTo('shopper');
    }

    public function createOrder(...$args)
    {
        return app(OrderGenerator::class)->generate($this, ...$args);
    }

    public function add(Purchasable $purchasable, $quantity = 1, $data = [], $refresh = true)
    {
        return app(
            config('shop.actions.add_to_cart', AddOrUpdatePurchasable::class)
        )->execute($this, $purchasable, $quantity, $data)
            ->then(fn() => $refresh ? $this->refresh()->calculate() : $this);
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
            'reference',
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
