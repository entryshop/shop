<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Contracts\ProductVariant as ProductVariantContract;
use Entryshop\Shop\Contracts\Purchasable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements Purchasable
{
    use VirtualColumn;
    use SoftDeletes;

    protected $guarded = [];

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function variants(): HasMany
    {
        return $this->hasMany(resolve_class(ProductVariantContract::class));
    }
}
