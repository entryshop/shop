<?php

use Entryshop\Shop\Base\ShopMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends ShopMigration {

    public function up(): void
    {
        Schema::create($this->table('coupons'), function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable()->index();
            $table->string('type')->nullable()->index();
            $table->string('name')->nullable()->index();
            $table->decimal('value', 26, 8)->nullable()->index();
            $table->string('handle')->nullable()->index();
            $table->mediumText('data')->nullable();
            $table->timestamps();
        });

        Schema::create($this->table('coupon_codes'), function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable()->index();
            $table->foreignId('coupon_id')->nullable()->index();
            $table->string('code')->nullable()->index();
            $table->string('status')->nullable()->index();
            $table->dateTime('valid_start_at')->nullable()->index();
            $table->dateTime('valid_end_at')->nullable()->index();
            $table->dateTime('used_at')->nullable()->index();
            $table->nullableMorphs('user');
            $table->mediumText('data')->nullable();
            $table->timestamps();
        });
    }
};
