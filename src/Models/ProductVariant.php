<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Base\ShopModel;
use Entryshop\Shop\Contracts\Purchasable;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends ShopModel implements Purchasable
{
    use VirtualColumn;
    use SoftDeletes;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(resolve_class(\Entryshop\Shop\Contracts\Product::class));
    }
}
