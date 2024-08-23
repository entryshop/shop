<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Contracts\Cart as CartContract;
use Entryshop\Shop\Contracts\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Cart extends Model implements CartContract
{
    use VirtualColumn;

    protected $guarded = [];

    public function lines()
    {
        return $this->hasMany(Line::class);
    }

    public function shopper(): MorphTo
    {
        return $this->morphTo('shopper');
    }

    public function createOrder(): Order
    {
        $order = app(Order::class)->create([
            'cart_id' => $this->id,
            'total'   => $this->total(),
        ]);

        return $order;
    }

    public function add($product, $quantity = 1)
    {
        $line = $this->lines()->where('product_id', $product->id)->first();

        if (empty($line)) {
            $line = $this->lines()->create([
                'product_id' => $product->id,
                'quantity'   => 0,
            ]);
        }

        $line->update([
            'quantity' => $line->quantity + $quantity,
        ]);

        return $line;
    }

    public function total()
    {
        foreach ($this->lines as $line) {
            $price = $line->product->price;
            $total = $price * $line->quantity;
            $line->update([
                'price' => $price,
                'total' => $total,
            ]);
        }
        return $this->lines()->sum('total');
    }
}
