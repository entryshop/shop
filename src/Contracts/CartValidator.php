<?php

namespace Entryshop\Shop\Contracts;

interface CartValidator
{
    public static function validate(Cart $cart): bool|array;
}
