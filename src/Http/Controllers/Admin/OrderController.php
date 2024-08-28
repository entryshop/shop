<?php

namespace Entryshop\Shop\Http\Controllers\Admin;

use Entryshop\Admin\Http\Controllers\CrudController;
use Entryshop\Admin\Http\Controllers\Traits\CanCrud;
use Entryshop\Shop\Models\Order;

class OrderController extends CrudController
{
    use CanCrud;

    public $model = Order::class;
    public $route = 'orders';
    public $lang = 'shop::order';

    public function beforeIndex()
    {
        $this->crud()->column('number');
        $this->crud()->column('total');
        $this->crud()->column('status');
        $this->crud()->column('payment_status');
    }
}
