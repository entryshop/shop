<?php

namespace Entryshop\Shop\Services;

use Entryshop\Shop\Contracts\Cart;
use Entryshop\Shop\Contracts\CartService as CartServiceContract;
use Entryshop\Shop\Contracts\Shopper;

class CartService implements CartServiceContract
{
    protected ?Cart $_cart = null;
    protected ?Shopper $_shopper = null;

    public function shopper($shopper)
    {
        $this->_shopper = $shopper;
    }

    public function current($create = false)
    {
        return $this->getCart($create);
    }

    public function setCart($cart)
    {
        $this->_cart = $cart;
    }

    public function getCart($create = false)
    {
        if (empty($this->_cart)) {

            if ($this->_shopper) {
                $this->_cart = app(Cart::class)
                    ->where('shopper_id', $this->_shopper->getKey())
                    ->where('shopper_type', $this->_shopper->getMorphClass())
                    ->active()
                    ->first();
            }

            if (!$this->_cart) {
                $this->_cart = app(Cart::class)->where('session_id', $this->session())->active()->first();
            }

            if (!$this->_cart && $create) {
                $this->_cart = app(Cart::class)->create([
                    'session_id' => $this->session(),
                    'active'     => true,
                ]);
            }
        }

        return $this->_cart;
    }

    public function associate($shopper)
    {
        $this->_cart->shopper()->associate($this->_shopper);
    }

    public function session()
    {
        return session()->getId();
    }
}
