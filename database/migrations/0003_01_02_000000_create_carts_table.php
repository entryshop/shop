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
            $table->string('reference')->unique()->index();
            $table->string('session_id')->nullable()->index();
            $table->string('status')->nullable()->index();
            $table->string('currency')->nullable()->index();
            $table->unsignedBigInteger('total')->nullable();
            $table->string('hash')->nullable()->unique();
            $table->boolean('active')->default(true)->index();
            $table->mediumText('data')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
