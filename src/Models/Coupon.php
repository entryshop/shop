<?php

namespace Entryshop\Shop\Models;

use Entryshop\Shop\Base\ShopModel;
use Entryshop\Utils\Models\Traits\HasReference;
use Entryshop\Utils\Models\Traits\VirtualColumn;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends ShopModel
{
    use VirtualColumn;
    use HasReference;

    public function codes(): HasMany
    {
        return $this->hasMany(CouponCode::class);
    }
}
