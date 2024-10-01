<?php

namespace Entryshop\Shop\Contracts;

use Illuminate\Support\Collection;

/**
 * @property string $coupon_code
 * @property string $shopper_id
 * @property float $sub_total
 * @property float $total
 * @property array $totals
 * @property array $shipping_address
 * @property array $billing_address
 * @property array $place
 * @property Collection<CartLine> $lines
 */
interface Cart
{
    public function add(Purchasable $purchasable, $quantity = 1, $data = []);

    public function updateLine($line, $quantity, $data = null);

    public function remove($line);

    public function calculate();

    public function lines();

    public function createOrder();
}
