<?php

use Entryshop\Shop\Base\ShopMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends ShopMigration {

    public function up(): void
    {
        Schema::create($this->table('channels'), function (Blueprint $table) {
            $table->id();
            $table->string('reference')->nullable()->index();
            $table->string('name')->nullable()->index();
            $table->string('status')->nullable()->index();
            $table->boolean('default')->nullable()->index();
            $table->mediumText('data')->nullable();
            $table->timestamps();
        });
    }
};
