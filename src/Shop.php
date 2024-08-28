<?php

namespace Entryshop\Shop;

use Entryshop\Admin\Admin\AdminPanel;

class Shop
{
    public static function registerAdminMenu($position = null)
    {
        if ($position === AdminPanel::MENU_POSITION_MAIN) {
            static::registerAdminMainMenu();
        }
    }

    public static function registerAdminMainMenu()
    {
        admin()->menu([
            'name'     => 'ecommerce',
            'position' => 'main',
            'type'     => 'divider',
            'label'    => 'E-Commerce',
        ]);
        admin()->menu([
            'name'     => 'orders',
            'position' => 'main',
            'label'    => 'Orders',
            'icon'     => 'fa-light fa-shopping-cart',
            'url'      => admin()->path('orders'),
        ]);
        admin()->menu([
            'name'     => 'products',
            'position' => 'main',
            'label'    => 'Products',
            'url'      => admin()->path('products'),
            'icon'     => 'fa-light fa-cubes',
        ]);
    }
}
