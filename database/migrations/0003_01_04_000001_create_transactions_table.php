<?php

use Entryshop\Shop\Base\ShopMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends ShopMigration {

    public function up(): void
    {
        Schema::create($this->table('transactions'), function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->index();
            $table->foreignId('cart_id')->nullable()->index();
            $table->string('reference')->unique()->index();
            $table->string('payment_type')->nullable()->index();
            $table->string('currency')->nullable()->index();
            $table->decimal('amount', 26, 8)->nullable()->index();
            $table->string('status')->nullable()->index();
            $table->string('external_id')->nullable()->index();
            $table->mediumText('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
