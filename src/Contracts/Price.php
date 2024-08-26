<?php

namespace Entryshop\Shop\Contracts;

interface Price
{
    public function toNumber();
    public function toString();
}
