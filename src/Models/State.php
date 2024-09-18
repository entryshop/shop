<?php

namespace Entryshop\Shop\Models;

use Entryshop\Shop\Base\ShopModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class State extends ShopModel
{
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
