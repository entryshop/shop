<?php

namespace Entryshop\Shop\Pipelines\Orders;

use Closure;
use Entryshop\Shop\Contracts\Order;

class UpdateOrderFulfillmentStatus
{
    public static function handle(Order $order, Closure $next)
    {
        $order->update([
            'fulfillment_status' => 'pending',
        ]);
        return $next($order);
    }
}
