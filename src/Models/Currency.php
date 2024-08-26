<?php

namespace Entryshop\Shop\Models;

use Entryshop\Shop\Models\Traits\HasDefaultRecord;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasDefaultRecord;

    protected $guarded = [];

}
