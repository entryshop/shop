<?php

namespace Entryshop\Shop\Contracts;

interface CartLine
{
    public function cart();

    public function purchasable();

    public function calculate();
}
