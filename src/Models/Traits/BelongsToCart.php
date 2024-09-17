<?php

namespace Entryshop\Shop\Models\Traits;

use Entryshop\Shop\Contracts\Cart;

trait BelongsToCart
{
    public function cart()
    {
        return $this->belongsTo(resolve_class(Cart::class));
    }
}
