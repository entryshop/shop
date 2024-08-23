<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use VirtualColumn;

    protected $guarded = [];

    public function getPrice()
    {
        return $this->price;
    }
}
