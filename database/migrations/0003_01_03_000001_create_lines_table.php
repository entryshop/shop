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
            $table->nullableMorphs('purchasable');
            $table->string('status')->nullable()->index();
            $table->integer('quantity')->default(1)->index();
            $table->string('price', 14)->nullable()->index();
            $table->string('total', 14)->default(0);
            $table->mediumText('data')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lines');
    }
};
