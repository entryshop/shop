<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Models\Traits\HasReference;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model implements \Entryshop\Shop\Contracts\Transaction
{
    use VirtualColumn;
    use HasReference;
    use SoftDeletes;

    protected $guarded = [];
    protected static $reference_prefix = 'tx_';

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
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
            'status',
            'order',
            'cart',
        ];
    }
}
