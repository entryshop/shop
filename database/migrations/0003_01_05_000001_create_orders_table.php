<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('shopper');
            $table->foreignId('cart_id')->nullable()->index();
            $table->string('number')->nullable()->index();
            $table->string('reference')->unique()->index();
            $table->string('status')->nullable()->index();
            $table->string('currency')->nullable()->index();
            $table->string('payment_status')->nullable()->index();
            $table->string('fulfillment_status')->nullable()->index();
            $table->unsignedBigInteger('total')->nullable()->index();
            $table->foreignId('currency_id')->nullable()->index();
            $table->mediumText('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
