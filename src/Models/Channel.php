<?php

namespace Entryshop\Shop\Models;

use Entryshop\Shop\Base\ShopModel;
use Entryshop\Utils\Models\Traits\HasDefaultRecord;
use Entryshop\Utils\Models\Traits\HasReference;
use Entryshop\Utils\Models\Traits\VirtualColumn;

class Channel extends ShopModel
{
    use VirtualColumn;
    use HasDefaultRecord;
    use HasReference;
}
