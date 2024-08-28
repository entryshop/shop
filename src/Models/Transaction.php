<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\HasReference;
use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Contracts\Cart;
use Entryshop\Shop\Contracts\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model implements \Entryshop\Shop\Contracts\Transaction
{
    use VirtualColumn;
    use HasReference;
    use SoftDeletes;

    protected $guarded = [];
    protected static $reference_prefix = 'txn_';

    public function cart(): BelongsTo
    {
        return $this->belongsTo(resolve_class(Cart::class));
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(resolve_class(Order::class));
    }

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'reference',
            'order_id',
            'cart_id',
            'payment_type',
            'amount',
            'currency',
            'status',
            'order',
            'cart',
            'external_id',
            'created_at',
            'updated_at',
        ];
    }
}
