<?php

namespace Entryshop\Shop\Exceptions;

use Exception;

class ShopException extends Exception
{
    // do not report
    public function report()
    {
        return false;
    }
}
