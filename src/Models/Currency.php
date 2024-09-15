<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\HasDefaultRecord;
use Entryshop\Shop\Base\ShopModel;
use Illuminate\Database\Eloquent\Model;

class Currency extends ShopModel
{
    use HasDefaultRecord;

    protected $guarded = [];
}
