<?php

use Entryshop\Shop\Base\ShopMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends ShopMigration {

    public function up(): void
    {
        Schema::create($this->table('products'), function (Blueprint $table) {
            $table->id();
            $table->boolean('has_variants')->default(false);
            $this->productCommonFields($table);
            $table->softDeletes();
        });

        Schema::create($this->table('product_options'), function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('order')->nullable();
            $table->mediumText('data')->nullable();
            $table->timestamps();
        });

        Schema::create($this->table('product_option_values'), function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_option_id');
            $table->string('name')->nullable();
            $table->integer('order')->nullable();
            $table->mediumText('data')->nullable();
            $table->timestamps();
        });

        Schema::create($this->table('product_variants'), function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained($this->table('products'));
            $table->text('attributes')->nullable();
            $this->productCommonFields($table);
            $table->softDeletes();
        });
    }

    private function productCommonFields($table)
    {
        $table->string('type')->nullable()->index();
        $table->string('status')->nullable()->index();
        $table->string('sku')->nullable()->index();
        $table->decimal('price', 26, 8)->nullable();
        $table->decimal('compare_price', 26, 8)->nullable()->index();
        $table->mediumText('description')->nullable();
        $table->string('name')->nullable();
        $table->text('images')->nullable();
        $table->mediumText('data')->nullable();
        $table->timestamps();
    }

};
