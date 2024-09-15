<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\HasReference;
use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Admin\Support\Searchable;
use Entryshop\Shop\Base\ShopModel;
use Entryshop\Shop\Contracts\Cart as CartContract;
use Entryshop\Shop\Contracts\Line as LineContract;
use Entryshop\Shop\Contracts\Order as OrderContract;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends ShopModel implements OrderContract
{
    use VirtualColumn;
    use HasReference;
    use SoftDeletes;
    use Searchable;

    protected $searches = [
        'number',
        'external_id',
        'data',
        'shopper.email',
        'shopper.name',
    ];

    protected $casts = [
        'totals' => 'array',
    ];

    protected $guarded = [];
    protected static $reference_prefix = 'ord_';

    public function lines(): HasMany
    {
        return $this->hasMany(resolve_class(LineContract::class));
    }

    public function shopper(): MorphTo
    {
        return $this->morphTo('shopper');
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(resolve_class(CartContract::class));
    }

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'reference',
            'number',
            'shopper_type',
            'shopper_id',
            'status',
            'payment_status',
            'fulfillment_status',
            'total',
            'created_at',
            'updated_at',
            'cart',
            'cart_id',
            'lines',
            'shopper',
            'currency',
            'external_id',
            'external_platform',
            'totals',
            'deleted_at',
        ];
    }
}
