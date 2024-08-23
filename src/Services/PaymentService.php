<?php

namespace Entryshop\Shop\Services;

use Entryshop\Shop\Contracts\PaymentService as PaymentServiceContract;
use Exception;

class PaymentService implements PaymentServiceContract
{

    protected $types;

    public function __construct()
    {
        $this->types = config('shop.payments.types');
    }

    public function extend($name, $type)
    {
        $this->types[$name] = $type;
    }

    protected function getAllTypes()
    {
        return $this->types;
    }

    public function driver($type = null)
    {
        $type ??= $this->getDefaultDriver();

        if (empty($this->getAllTypes()[$type])) {
            throw new Exception('Payment type not found');
        }

        return app($this->getAllTypes()[$type]);
    }

    public function getDefaultDriver()
    {
        return config('shop.payments.default');
    }
}
