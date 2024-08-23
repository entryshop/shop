<?php

namespace Entryshop\Shop\Contracts;

interface Cart
{
    public function createOrder(): Order;
}
