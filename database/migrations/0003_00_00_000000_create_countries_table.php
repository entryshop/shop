<?php

use Entryshop\Shop\Base\ShopMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends ShopMigration {

    public function up(): void
    {
        Schema::create($this->table('countries'), function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('iso3')->unique();
            $table->string('iso2')->unique()->nullable();
            $table->string('phonecode')->nullable();
            $table->string('capital')->nullable();
            $table->string('currency')->nullable();
            $table->string('native')->nullable();
            $table->string('emoji')->nullable();
            $table->string('emoji_u')->nullable();
            $table->timestamps();
        });

        Schema::create($this->table('states'), function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->nullable()->constrained($this->table('countries'));
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->timestamps();
        });

    }

};
