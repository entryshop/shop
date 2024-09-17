<?php

namespace Entryshop\Shop\Services;

use Entryshop\Shop\Contracts\Cart;

/**
 * @mixin Cart
 */
class CartService
{
    protected $_cart;
    protected $_shopper;

    public function shopper($shopper = null)
    {
        if (empty($shopper)) {
            return $this->_shopper;
        }
        $this->_shopper = $shopper;
        return $this;
    }

    public function current($create = false)
    {
        if ($this->_cart) {
            return $this->_cart;
        }

        if ($this->_shopper) {
            if ($cart = app(Cart::class)->where([
                'shopper_id'   => $this->_shopper->id,
                'shopper_type' => $this->_shopper->getMorphClass(),
                'active'       => true,
            ])->first()) {
                $this->_cart = $cart;
                return $this->_cart;
            }
        }

        if ($create) {
            if ($this->_shopper) {
                $data = [
                    'shopper_id'   => $this->_shopper->id,
                    'shopper_type' => $this->_shopper->getMorphClass(),
                ];
            } else {
                $data = [
                    'session_id' => session()->getId(),
                ];
            }

            $data['active'] = true;

            $this->_cart = app(Cart::class)
                ->create($data);

            return $this->_cart;
        }

        return null;
    }

    public function cart($cart)
    {
        $this->_cart = $cart;
        return $this;
    }

    public function __call($method, $args)
    {
        if (empty($this->_cart)) {
            $this->current(true);
        }

        if ($this->_cart) {
            return $this->_cart->{$method}(...$args);
        }

        return $this;
    }
}
