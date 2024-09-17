<?php

namespace Entryshop\Shop\Base;

use Entryshop\Shop\Contracts\Transaction;
use Entryshop\Shop\Events\Transaction\Captured;

abstract class AbstractPaymentType
{
    public Transaction $transaction;

    /**
     * Any config for this payment provider.
     */
    protected array $config = [];

    /**
     * Data storage.
     */
    protected array $data = [];

    public function transaction($transaction)
    {
        $this->transaction = $transaction;
        return $this;
    }

    public function withData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function setConfig(array $config): self
    {
        $this->config = $config;

        return $this;
    }

    abstract public function authorize();

    public function capture($amount = null)
    {
        $this->transaction->setStatus('captured');
        Captured::dispatch($this->transaction);
    }

    abstract public function refund($amount = null);
}
