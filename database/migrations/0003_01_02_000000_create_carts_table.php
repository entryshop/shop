<?php

use Entryshop\Shop\Base\ShopMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends ShopMigration {

    public function up(): void
    {
        Schema::create($this->table('carts'), function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('shopper');
            $table->string('reference')->unique()->index();
            $table->string('session_id')->nullable()->index();
            $table->string('status')->nullable()->index();
            $table->string('currency')->nullable()->index();
            $table->string('channel')->nullable()->index();
            $table->decimal('total', 26, 8)->nullable();
            $table->string('hash')->nullable()->unique();
            $table->boolean('active')->default(true)->index();
            $table->dateTime('locked_until')->nullable();
            $table->text('totals')->nullable();
            $table->text('shipping_address')->nullable();
            $table->text('billing_address')->nullable();
            $table->text('payments')->nullable();
            $table->mediumText('data')->nullable();
            $table->timestamps();
        });
    }

};
