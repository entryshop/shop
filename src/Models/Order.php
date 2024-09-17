<?php

namespace Entryshop\Shop\Models;

use Entryshop\Shop\Base\ShopModel;
use Entryshop\Shop\Models\Traits\BelongsToCart;
use Entryshop\Shop\Models\Traits\BelongsToShopper;
use Entryshop\Utils\Models\Traits\HasReference;
use Entryshop\Utils\Models\Traits\VirtualColumn;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends ShopModel
{
    use VirtualColumn;
    use SoftDeletes;
    use HasReference;
    use BelongsToCart;
    use BelongsToShopper;

    protected $casts = [
        'totals' => 'array',
    ];

    public function lines()
    {
        return $this->hasMany(OrderLine::class);
    }
}
