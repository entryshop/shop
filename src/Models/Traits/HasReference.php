<?php

namespace Entryshop\Shop\Models\Traits;

use Illuminate\Support\Str;

/**
 * @property static $reference_prefix
 */
trait HasReference
{

    protected static function bootHasReference()
    {
        static::creating(function ($model) {
            if (empty($model->reference)) {
                $model->reference = (static::$reference_prefix ?? '') . Str::ulid();
            }
        });
    }
}
