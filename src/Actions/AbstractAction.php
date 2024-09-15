<?php

namespace Entryshop\Shop\Actions;

use Closure;

abstract class AbstractAction
{

    protected mixed $passThrough = null;

    public static function make()
    {
        return app(static::class);
    }

    public static function run(...$arguments)
    {
        return static::make()->execute(...$arguments);
    }

    public function then(Closure $callback)
    {
        return $callback($this->passThrough);
    }
}
