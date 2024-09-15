<?php

namespace Entryshop\Shop\Base;

use Entryshop\Shop\Actions\AbstractAction;
use Entryshop\Shop\Contracts\Line;

abstract class LineRule extends AbstractAction
{
    abstract public function apply($line): Line;
}
