<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\HasReference;
use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Base\ShopModel;
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
