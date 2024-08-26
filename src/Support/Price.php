<?php

namespace Entryshop\Shop\Support;

use Illuminate\Support\Number;

class Price implements \Entryshop\Shop\Contracts\Price
{
    public function __construct(
        public int $value,
        public string $currency = 'USD',
        public int $decimals = 0,
        public string $locale = 'en_US',
    ) {
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function toString($locale = null)
    {
        $value_number = $this->toNumber();

        $locale ??= $this->locale;

        return Number::currency($value_number, $this->currency, $locale);
    }

    public function toNumber()
    {
        return $this->value / pow(10, $this->decimals);
    }
}
