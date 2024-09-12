<?php

namespace Entryshop\Shop\Events\Orders;

use Entryshop\Shop\Events\BaseEvent;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;

class OrderCreated extends BaseEvent implements ShouldDispatchAfterCommit
{
    public function __construct(public $order)
    {
    }
}
