<?php

namespace Entryshop\Shop\Base\DataTransfer;

class PaymentAuthorize
{
    public function __construct(
        public bool $success = false,
        public ?string $message = null,
        public ?int $orderId = null,
        public ?string $paymentType = null
    ) {
        //
    }
}
