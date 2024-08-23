<?php

namespace Entryshop\Shop\Services;

use Entryshop\Shop\Contracts\Cart;
use Entryshop\Shop\Contracts\CartService as CartServiceContract;

class CartService implements CartServiceContract
{
    protected ?Cart $_cart = null;

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
            $this->_cart = app(Cart::class)->where('session_id', $this->session())->first();
            if (!$this->_cart && $create) {
                $this->_cart = app(Cart::class)->create([
                    'session_id' => $this->session(),
                ]);
            }
        }

        return $this->_cart;
    }

    public function session()
    {
        return session()->getId();
    }
}
