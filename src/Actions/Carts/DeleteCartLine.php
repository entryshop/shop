<?php

namespace Entryshop\Shop\Actions\Carts;

use Entryshop\Shop\Actions\AbstractAction;

class DeleteCartLine extends AbstractAction
{
    public function execute(
        $line
    ) {
        $line->delete();
        return $this;
    }
}
