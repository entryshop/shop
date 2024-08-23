<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Contracts\Order as OrderContract;
use Illuminate\Database\Eloquent\Model;

class Order extends Model implements OrderContract
{
    use VirtualColumn;

    protected $guarded = [];
}
