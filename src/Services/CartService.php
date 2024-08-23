<?php

namespace Entryshop\Shop\Services;

use Entryshop\Shop\Contracts\Cart;
use Entryshop\Shop\Contracts\CartService as CartServiceContract;

class CartService implements CartServiceContract
{
    protected Cart $_cart;

    public function current()
    {
        return $this->getCart();
    }

    public function setCart($cart)
    {
        $this->_cart = $cart;
    }

    public function getCart()
    {
        if (empty($this->_cart)) {
            $this->_cart = app(Cart::class)->firstOrCreate([
                'session_id' => $this->session(),
            ]);
        }
        return $this->_cart;
    }

    public function session()
    {
        return session()->getId();
    }
}
