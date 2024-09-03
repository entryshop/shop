<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table) {
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

        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->string('name');
            $table->string('code');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('states');
        Schema::dropIfExists('countries');
    }
};
