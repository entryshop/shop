<?php

namespace Entryshop\Shop\Models\Traits;

trait BelongsToShopper
{
    public function shopper()
    {
        return $this->morphTo();
    }
}
