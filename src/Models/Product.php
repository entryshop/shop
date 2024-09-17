<?php

namespace Entryshop\Shop\Models;

use Entryshop\Shop\Base\ShopModel;
use Entryshop\Shop\Contracts\Purchasable;
use Entryshop\Utils\Models\Traits\VirtualColumn;

class Product extends ShopModel implements Purchasable
{
    use VirtualColumn;

    protected $casts = [
        'images' => 'array',
    ];

    public function getPrice()
    {
        return $this->price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSku()
    {
        return $this->sku;
    }

    public function getImage()
    {
        return $this->images[0] ?? '';
    }
}
