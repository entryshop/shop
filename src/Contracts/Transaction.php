<?php

namespace Entryshop\Shop\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 * @property Cart $cart
 * @property Order $order
 */
interface Transaction
{
}
