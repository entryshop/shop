<?php

use Entryshop\Shop\Base\ShopMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends ShopMigration {

    public function up(): void
    {
        Schema::create($this->table('orders'), function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('shopper');
            $table->foreignId('cart_id')->nullable()->index();
            $table->string('number')->nullable()->index();
            $table->string('reference')->nullable()->index();
            $table->string('status')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('currency')->nullable()->index();
            $table->string('payment_status')->nullable()->index();
            $table->string('external_id')->nullable()->index();
            $table->string('external_platform')->nullable()->index();
            $table->string('fulfillment_status')->nullable()->index();
            $table->integer('quantity')->nullable();
            $table->decimal('sub_total', 26, 8)->nullable();
            $table->decimal('total', 26, 8)->nullable();
            $table->text('totals')->nullable();
            $table->text('shipping_address')->nullable();
            $table->text('billing_address')->nullable();
            $table->mediumText('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create($this->table('order_lines'), function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->nullableMorphs('purchasable');
            $table->string('name')->nullable();
            $table->string('sku')->nullable();
            $table->string('image')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('price', 26, 8)->nullable();
            $table->decimal('total', 26, 8)->nullable();
            $table->text('data')->nullable();
            $table->timestamps();
        });
    }
};
