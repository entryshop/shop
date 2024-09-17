<?php

namespace Entryshop\Shop\Models;

use Entryshop\Shop\Base\ShopModel;
use Entryshop\Shop\Models\Traits\BelongsToCart;
use Entryshop\Utils\Models\Traits\HasReference;
use Entryshop\Utils\Models\Traits\VirtualColumn;

class Transaction extends ShopModel implements \Entryshop\Shop\Contracts\Transaction
{
    use VirtualColumn;
    use BelongsToCart;
    use HasReference;

    public function getPaymentDriver()
    {
        return $this->payment_type;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->update([
            'status' => $status,
        ]);
    }

}
