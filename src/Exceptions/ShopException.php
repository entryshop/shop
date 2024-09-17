<?php

namespace Entryshop\Shop\Exceptions;

use Exception;

class ShopException extends Exception
{
    public function report()
    {
        return false;
    }
}
