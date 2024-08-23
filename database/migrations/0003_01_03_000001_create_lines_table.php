<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('lines', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('order_id')->nullable()->index();
            $table->foreignUlid('cart_id')->nullable()->index();
            $table->foreignUlid('product_id')->nullable()->index();
            $table->string('sku')->nullable()->index();
            $table->string('status')->nullable()->index();
            $table->string('name')->nullable()->index();
            $table->string('description')->nullable()->index();
            $table->string('image')->nullable();
            $table->string('note')->nullable();
            $table->integer('quantity')->default(1)->index();
            $table->decimal('original_price', 14)->nullable()->index();
            $table->decimal('price', 14)->nullable()->index();
            $table->decimal('sub_total', 14)->default(0);
            $table->decimal('total', 14)->default(0);
            $table->boolean('requires_shipping')->nullable()->index();
            $table->boolean('is_selected')->default(true)->index();
            $table->mediumText('data')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lines');
    }
};
