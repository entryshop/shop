<?php

namespace Entryshop\Shop\PaymentTypes;

use Entryshop\Admin\Support\HasContext;
use Entryshop\Shop\Base\DataTransfer\PaymentAuthorize;
use Entryshop\Shop\Contracts\Cart;
use Entryshop\Shop\Contracts\Order;

/**
 * @method PaymentAuthorize authorize(...$args)
 */
abstract class AbstractPayment
{
    use HasContext;

    protected $name;
    /**
     * The instance of the cart.
     */
    protected ?Cart $cart = null;

    /**
     * The instance of the order.
     */
    protected ?Order $order = null;

    public function cart(Cart $cart): self
    {
        $this->cart  = $cart;
        $this->order = null;

        return $this;
    }

    public function order(Order $order): self
    {
        $this->order = $order;
        $this->cart  = null;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

}
