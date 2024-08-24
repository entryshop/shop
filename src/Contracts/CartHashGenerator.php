<?php

namespace Entryshop\Shop\Contracts;

interface CartHashGenerator
{
    public static function generate(Cart $cart): string;
}
