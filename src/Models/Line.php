<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Contracts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Line extends Model implements Contracts\Line
{
    use VirtualColumn;

    protected $guarded = [];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(resolve_class(Contracts\Cart::class));
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(resolve_class(Contracts\Order::class));
    }

    public function purchasable(): MorphTo
    {
        return $this->MorphTo();
    }

    public function getTotal(): Contracts\Price
    {
        return app(Contracts\Price::class, [
            'value'    => $this->total,
            'currency' => $this->cart->currency ?? config('shop.default_currency'),
            'decimals' => config('shop.default_currency_decimals'),
            'locale'   => $locale ?? app()->getLocale(),
        ]);
    }

    public function getUnitPrice(): Contracts\Price
    {
        return app(Contracts\Price::class, [
            'value'    => $this->price,
            'currency' => $this->cart->currency ?? config('shop.default_currency'),
            'decimals' => config('shop.default_currency_decimals'),
            'locale'   => $locale ?? app()->getLocale(),
        ]);
    }

    public static function getCustomColumns()
    {
        return [
            'id',
            'order_id',
            'cart_id',
            'purchasable_id',
            'purchasable_type',
            'purchasable',
            'status',
            'quantity',
            'price',
            'total',
            'cart',
            'created_at',
            'updated_at',
        ];
    }
}
