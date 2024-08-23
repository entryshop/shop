<?php

namespace Entryshop\Shop\Base\DataTransfer;

class PaymentRefund
{
    public function __construct(
        public bool $success = false,
        public ?string $message = null
    ) {
        //
    }
}
