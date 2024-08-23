<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Line extends Model
{
    use VirtualColumn;

    protected $guarded = [];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
