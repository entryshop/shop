<?php

namespace Entryshop\Shop\Actions\Cart;

use Entryshop\Utils\Actions\AsAction;

class RemoveCartLine
{
    use AsAction;

    public function handle($line)
    {
        $line->delete();
        return $this;
    }
}
