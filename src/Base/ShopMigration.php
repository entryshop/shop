<?php

namespace Entryshop\Shop\Base;

use Illuminate\Database\Migrations\Migration;

class ShopMigration extends Migration
{
    public function table($name)
    {
        return config('shop.database.prefix') . $name;
    }
}
