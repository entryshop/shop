<?php

namespace Entryshop\Shop\Contracts;

interface CartCalculator
{
    public static function calculate(Cart $cart): Cart;
}
