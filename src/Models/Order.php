<?php

namespace Entryshop\Shop\Models;

use Entryshop\Shop\Base\ShopModel;
use Entryshop\Shop\Models\Traits\BelongsToCart;
use Entryshop\Shop\Models\Traits\BelongsToShopper;
use Entryshop\Utils\Models\Traits\HasReference;
use Entryshop\Utils\Models\Traits\Searchable;
use Entryshop\Utils\Models\Traits\VirtualColumn;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends ShopModel implements \Entryshop\Shop\Contracts\Order
{
    use VirtualColumn;
    use SoftDeletes;
    use HasReference;
    use BelongsToCart;
    use BelongsToShopper;
    use Searchable;

    public $searches = ['number', 'id', 'email'];

    protected $casts = [
        'shipping_address' => 'array',
        'billing_address'  => 'array',
        'totals'           => 'array',
    ];

    public function lines()
    {
        return $this->hasMany(OrderLine::class);
    }
}
