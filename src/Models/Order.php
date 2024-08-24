<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Contracts\Order as OrderContract;
use Entryshop\Shop\Models\Traits\HasReference;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model implements OrderContract
{
    use VirtualColumn;
    use HasReference;
    use SoftDeletes;

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
        return $this->belongsTo(get_class(resolve(\Entryshop\Shop\Contracts\Cart::class)));
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
