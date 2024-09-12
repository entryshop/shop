<?php

namespace Entryshop\Shop\Models;

use Entryshop\Admin\Support\Model\HasReference;
use Entryshop\Admin\Support\Model\VirtualColumn;
use Entryshop\Shop\Actions\Carts\AddOrUpdatePurchasable;
use Entryshop\Shop\Actions\Carts\CartHashGenerator;
use Entryshop\Shop\Actions\Carts\DeleteCartLine;
use Entryshop\Shop\Contracts;
use Entryshop\Shop\Contracts\Cart as CartContract;
use Entryshop\Shop\Contracts\Purchasable;
use Entryshop\Shop\Events\Orders\OrderCreated;
use Entryshop\Shop\Exceptions\ShopException;
use Entryshop\Shop\Pipelines\Carts\CartCalculator;
use Entryshop\Shop\Pipelines\Carts\CartValidator;
use Entryshop\Shop\Support\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Pipeline\Pipeline;

class Cart extends Model implements CartContract
{
    use VirtualColumn;
    use HasReference;

    protected static $reference_prefix = 'cart_';

    protected $guarded = [];

    protected $casts = [
        'active' => 'boolean',
        'locked_until' => 'datetime'
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function lines()
    {
        return $this->hasMany(resolve_class(Contracts\Line::class));
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(resolve_class(Contracts\Order::class));
    }

    public function shopper(): MorphTo
    {
        return $this->morphTo('shopper');
    }

    public function createOrder(...$args)
    {
        $cart = $this->calculate();

        hook_action('cart.order.creating', [
            'cart' => $cart,
            ...$args,
        ]);

        $order = app(
            config('shop.actions.create_order')
        )->execute($cart, ...$args);

        $order = app(Pipeline::class)
            ->send($order)
            ->through(
                config('shop.pipelines.order_created')
            )->thenReturn();

        OrderCreated::dispatch($order);
        return $order;
    }

    public function updateLine($line_id, $quantity = 1, $data = [], $refresh = true)
    {
        $this->beforeUpdate();
        $line = $this->lines()->findOrFail($line_id);
        hook_action('cart.line.updating', $line);
        $cart = app(
            config('shop.actions.add_to_cart', AddOrUpdatePurchasable::class)
        )->execute($this, $line, $quantity, $data)
            ->then(fn() => $refresh ? $this->refresh()->calculate() : $this);
        hook_action('cart.line.updated', $line);
        return $cart;
    }

    public function add(Purchasable $purchasable, $quantity = 1, $data = [], $refresh = true)
    {
        $this->beforeUpdate();
        hook_action('cart.line.adding', compact('purchasable', 'quantity', 'data'));
        return app(
            config('shop.actions.add_to_cart', AddOrUpdatePurchasable::class)
        )->execute($this, $purchasable, $quantity, $data)
            ->then(fn() => $refresh ? $this->refresh()->calculate() : $this);
    }

    public function deleteLine($line, $refresh = true)
    {
        $this->beforeUpdate();
        if ($line instanceof Contracts\Line) {
            $line = $this->lines()->findOrFail($line->getKey());
        } else {
            $line = $this->lines()->findOrFail($line);
        }

        return app(
            config('shop.actions.remove_from_cart', DeleteCartLine::class)
        )->execute($line)
            ->then(fn() => $refresh ? $this->refresh()->calculate() : $this);
    }

    public function calculate()
    {
        $this->beforeUpdate();
        $cart = app(Pipeline::class)
            ->send($this)
            ->through(
                config('shop.pipelines.cart_calculate', [
                    CartCalculator::class,
                ])
            )->thenReturn();

        $cart->save();

        $hash = app(
            config('shop.actions.hash_generate', CartHashGenerator::class)
        )->execute($this);

        $cart->update([
            'hash' => $hash,
        ]);
        return $cart;
    }

    public function validate($throw = true)
    {
        $this->beforeUpdate();
        $result = app(Pipeline::class)
            ->send([
                'cart'   => $this,
                'errors' => [],
                'throw'  => $throw,
            ])
            ->through(
                config('shop.pipelines.cart_validate', [
                    CartValidator::class,
                ])
            )->thenReturn();

        if (empty($result['errors'])) {
            return true;
        }
        return $result['errors'];
    }

    public function getTotal($locale = null): Price
    {
        return app(Contracts\Price::class, [
            'value'    => $this->total,
            'currency' => $this->currency ?? config('shop.default_currency'),
            'decimals' => config('shop.default_currency_decimals'),
            'locale'   => $locale ?? app()->getLocale(),
        ]);
    }

    public function lock($minutes = 5)
    {
        $this->update([
            'locked_until' => now()->addMinutes($minutes),
        ]);
        return $this;
    }

    public function beforeUpdate()
    {
        if (!$this->canUpdate()) {
            throw new ShopException('Can not update cart now');
        }
    }

    public function unLock()
    {
        $this->update([
            'locked_until' => null,
        ]);
        return $this;
    }

    public function isLocked(): bool
    {
        return !is_null($this->locked_until) && $this->locked_until->isFuture();
    }

    public function canUpdate()
    {
        return $this->active && !$this->isLocked();
    }

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'reference',
            'shopper_type',
            'shopper_id',
            'session_id',
            'status',
            'total',
            'hash',
            'active',
            'created_at',
            'updated_at',
            'order',
            'lines',
            'shopper',
            'locked_until',
            'currency',
        ];
    }
}
