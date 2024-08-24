<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Contracts\Purchasable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements Purchasable
{
    use VirtualColumn;

    protected $guarded = [];

    public function getPrice()
    {
        return $this->price;
    }
}
