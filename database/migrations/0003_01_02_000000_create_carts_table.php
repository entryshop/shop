<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->nullableMorphs('shopper');
            $table->string('session_id')->nullable()->index();
            $table->string('channel')->nullable();
            $table->string('currency')->nullable();
            $table->string('status')->nullable()->index();
            $table->text('customer')->nullable()->comment('Anonymized customer data');
            $table->text('shipping')->nullable();
            $table->text('payment')->nullable();
            $table->text('coupons')->nullable();
            $table->boolean('active')->default(true)->index();
            $table->string('seller_note')->nullable();
            $table->string('buyer_note')->nullable();
            $table->timestamp('locked_until')->nullable();
            $table->mediumText('data')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
