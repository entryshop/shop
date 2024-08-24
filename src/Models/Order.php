<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Contracts\Order as OrderContract;
use Entryshop\Shop\Models\Traits\HasReference;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Order extends Model implements OrderContract
{
    use VirtualColumn;
    use HasReference;

    protected $guarded = [];
    protected static $reference_prefix = 'ord_';

    public function lines(): HasMany
    {
        return $this->hasMany(Line::class);
    }

    public function shopper(): MorphTo
    {
        return $this->morphTo('shopper');
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'reference',
            'shopper_type',
            'shopper_id',
            'status',
            'payment_status',
            'total',
            'created_at',
            'updated_at',
            'cart',
            'cart_id',
            'lines',
            'shopper',
        ];
    }

}
