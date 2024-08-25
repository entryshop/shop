<?php

namespace Entryshop\Shop\Contracts;

interface Line
{
    public function cart();

    public function order();

    public function purchasable();

}
