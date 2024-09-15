<?php

namespace Entryshop\Shop\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ShopModel extends Model
{

    public function getTable()
    {
        return $this->table ?? config('shop.database.prefix') . Str::snake(Str::pluralStudly(class_basename($this)));
    }
}
