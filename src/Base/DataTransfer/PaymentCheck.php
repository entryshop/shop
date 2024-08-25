<?php

namespace Entryshop\Shop\Base\DataTransfer;

class PaymentCheck
{
    public function __construct(
        public bool $successful,
        public string $label,
        public string $message
    ) {
    }
}
