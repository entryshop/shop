<?php

use Entryshop\Shop\Base\ShopMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends ShopMigration {

    public function up(): void
    {
        Schema::create($this->table('lines'), function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('order_id')->nullable()->index();
            $table->foreignUlid('cart_id')->nullable()->index();
            $table->nullableMorphs('purchasable');
            $table->string('status')->nullable()->index();
            $table->integer('quantity')->default(1)->index();
            $table->decimal('price', 26, 8)->nullable();
            $table->decimal('total', 26, 8)->nullable();
            $table->mediumText('data')->nullable();
            $table->timestamps();
        });
    }
};
