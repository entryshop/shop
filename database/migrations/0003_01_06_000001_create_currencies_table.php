<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends \Entryshop\Shop\Base\ShopMigration {

    public function up(): void
    {
        Schema::create($this->table('currencies'), function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->boolean('default')->nullable();
            $table->integer('decimal_places')->nullable();
            $table->decimal('exchange_rate', 10, 4)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
