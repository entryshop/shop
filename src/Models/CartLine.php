<?php

namespace Entryshop\Shop\Models;

use Entryshop\Shop\Base\ShopModel;
use Entryshop\Utils\Models\Traits\VirtualColumn;
use Entryshop\Utils\Support\CachesProperties;

class CartLine extends ShopModel implements \Entryshop\Shop\Contracts\CartLine
{
    use VirtualColumn;
    use CachesProperties;

    public $cachableProperties = [
        'price',
        'total',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function purchasable()
    {
        return $this->morphTo();
    }

    public function calculate()
    {
        $this->unitPrice = $this->purchasable->getPrice();
        $this->subTotal  = $this->unitPrice * $this->quantity;
    }
}
