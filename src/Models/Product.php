<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Contracts\Purchasable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements Purchasable
{
    use VirtualColumn;
    use SoftDeletes;

    protected $guarded = [];

    public function getPrice()
    {
        return $this->price;
    }
}
