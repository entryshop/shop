<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $this->productCommonFields($table);
            $table->mediumText('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    private function productCommonFields($table)
    {
        $table->string('status')->nullable();
        $table->unsignedInteger('price')->nullable();
        $table->string('sku')->unique()->nullable()->index();
        $table->mediumText('description')->nullable();
        $table->string('name')->nullable();
        $table->text('images')->nullable();
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
