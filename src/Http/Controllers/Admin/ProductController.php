<?php

namespace Entryshop\Shop\Http\Controllers\Admin;

use Entryshop\Admin\Http\Controllers\CrudController;
use Entryshop\Admin\Http\Controllers\Traits\CanCrud;
use Entryshop\Shop\Models\Product;

class ProductController extends CrudController
{
    use CanCrud;

    public $model = Product::class;
    public $route = 'products';
    public $lang = 'shop::product';

    public function beforeIndex()
    {
        $this->crud()->button()->top('top_create');
        $this->crud()->column('name');
        $this->crud()->column('price');
        $this->crud()->column('sku');
    }
}
