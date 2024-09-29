<?php

namespace Entryshop\Shop\Models;

use Entryshop\Shop\Base\ShopModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends ShopModel
{
    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}
