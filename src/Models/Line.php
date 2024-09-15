<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Base\ShopModel;
use Entryshop\Shop\Contracts;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Line extends ShopModel implements Contracts\Line
{
    use VirtualColumn;

    protected $guarded = [];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(resolve_class(Contracts\Cart::class), 'cart_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(resolve_class(Contracts\Order::class), 'order_id');
    }

    public function purchasable(): MorphTo
    {
        return $this->MorphTo();
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
            'name',
            'image',
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
