<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->boolean('has_variants')->default(false);
            $this->productCommonFields($table);
            $table->softDeletes();
        });

        Schema::create('product_options', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::create('product_option_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_option_id');
            $table->string('name')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
        });

        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id');
            $this->productCommonFields($table);
            $table->softDeletes();
        });
    }

    private function productCommonFields($table)
    {
        $table->string('status')->nullable();
        $table->unsignedInteger('price')->nullable();
        $table->unsignedInteger('compare_price')->nullable();
        $table->string('sku')->unique()->nullable()->index();
        $table->mediumText('description')->nullable();
        $table->string('name')->nullable();
        $table->text('images')->nullable();
        $table->mediumText('data')->nullable();
        $table->timestamps();
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_variants');
    }
};
