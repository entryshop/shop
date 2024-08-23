<?php

namespace Entryshop\Shop\Base\DataTransfer;

class PaymentCapture
{
    public function __construct(
        public bool $success = false,
        public string $message = ''
    ) {
        //
    }
}
