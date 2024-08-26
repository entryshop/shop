<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable()->index();
            $table->foreignId('cart_id')->nullable()->index();
            $table->string('reference')->unique()->index();
            $table->string('payment_type')->nullable()->index();
            $table->string('currency')->nullable()->index();
            $table->unsignedBigInteger('amount')->nullable()->index();
            $table->string('status')->nullable()->index();
            $table->string('external_id')->nullable()->index();
            $table->mediumText('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lines');
    }
};
