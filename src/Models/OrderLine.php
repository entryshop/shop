<?php

namespace Entryshop\Shop\Models;

use Entryshop\Shop\Base\ShopModel;
use Entryshop\Utils\Models\Traits\VirtualColumn;

class OrderLine extends ShopModel
{
    use VirtualColumn;
}
