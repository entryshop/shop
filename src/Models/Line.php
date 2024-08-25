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
        return $this->belongsTo(get_class(resolve(Contracts\Cart::class)));
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(get_class(resolve(Contracts\Order::class)));
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
