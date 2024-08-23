<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use VirtualColumn;

    protected $guarded = [];
}
