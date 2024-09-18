<?php

namespace Entryshop\Shop\Models;

use Entryshop\Shop\Base\ShopModel;
use Entryshop\Utils\Models\Traits\VirtualColumn;
use Entryshop\Utils\Models\Traits\HasReference;

class CouponCode extends ShopModel
{
    use VirtualColumn;
    use HasReference;

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
