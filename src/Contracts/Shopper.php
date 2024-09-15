<?php

namespace Entryshop\Shop\Contracts;

/**
 * @property string $name
 * @property string $email
 */
interface Shopper
{
    public function getKey();
}
