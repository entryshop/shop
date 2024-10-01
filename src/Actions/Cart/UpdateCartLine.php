<?php

namespace Entryshop\Shop\Actions\Cart;

use Entryshop\Utils\Actions\AsAction;

class UpdateCartLine
{
    use AsAction;

    public function handle(
        $line,
        int $quantity,
        $data = null
    ): self {
        $line->update([
            'quantity' => $quantity,
        ]);

        if (!empty($data)) {
            $line->setData($data);
        }

        return $this;
    }
}
