<?php

use Entryshop\Shop\Base\ShopMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends ShopMigration {

    public function up(): void
    {
        Schema::create($this->table('rules'), function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable()->index();
            $table->string('scope')->nullable()->index()->comment('for cart or line');
            $table->string('type')->nullable()->index();
            $table->string('name')->nullable()->index();
            $table->boolean('active')->nullable()->index();
            $table->mediumText('data')->nullable();
            $table->timestamps();
        });
    }
};
