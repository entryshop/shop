<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\HasReference;
use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Base\ShopModel;

class CouponCode extends ShopModel
{
    use VirtualColumn;
    use HasReference;

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
