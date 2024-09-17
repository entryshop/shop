<?php

namespace Entryshop\Shop\Models\Traits;

use Entryshop\Shop\Exceptions\ShopException;

trait Lockable
{
    public function lock($minutes = 5)
    {
        $this->update([
            'locked_until' => now()->addMinutes($minutes),
        ]);
        return $this;
    }

    public function beforeUpdate()
    {
        if (!$this->canUpdate()) {
            throw new ShopException('Can not update cart now');
        }
    }

    public function unLock()
    {
        $this->update([
            'locked_until' => null,
        ]);
        return $this;
    }

    public function isLocked(): bool
    {
        return !is_null($this->locked_until) && $this->locked_until->isFuture();
    }

    public function canUpdate()
    {
        return $this->active && !$this->isLocked();
    }
}
