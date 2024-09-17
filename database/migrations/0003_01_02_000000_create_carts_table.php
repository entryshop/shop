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
            $table->string('reference')->nullable()->index();
            $table->string('session_id')->nullable()->index();
            $table->string('hash')->nullable()->index();
            $table->boolean('active')->default(true)->index();
            $table->dateTime('locked_until')->nullable();
            $table->text('data')->nullable();
            $table->timestamps();
        });

        Schema::create($this->table('cart_lines'), function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id');
            $table->nullableMorphs('purchasable');
            $table->boolean('active')->default(true)->index();
            $table->integer('quantity')->nullable();
            $table->boolean('selected')->default(true)->index();
            $table->text('data')->nullable();
            $table->timestamps();
        });
    }
};
