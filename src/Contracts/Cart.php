<?php

namespace Entryshop\Shop\Contracts;

interface Cart
{
    public function add(Purchasable $purchasable, $quantity = 1, $data = []);

    public function updateLine($line, $quantity, $data = null);

    public function remove($line);

    public function calculate();

    public function lines();

    public function createOrder();
}
