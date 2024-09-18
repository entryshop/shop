<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Models\Coupon;
use Entryshop\Shop\Base\ShopModel;

class CouponCode extends ShopModel
{
    use VirtualColumn;

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
