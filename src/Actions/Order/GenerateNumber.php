<?php

namespace Entryshop\Shop\Actions\Order;

use Entryshop\Shop\Contracts\Order;
use Entryshop\Utils\Actions\AsAction;

class GenerateNumber
{
    use AsAction;

    public function handle()
    {
        return 1000 + app(Order::class)->count();
    }
}
