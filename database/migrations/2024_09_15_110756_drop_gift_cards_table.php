<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('gift_cards');
        Schema::dropIfExists('user_gift_cards');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('gift_cards', function (Blueprint $table) {
            $table->id();
            $table->longText('link');
            $table->integer('amount');
            $table->timestamps();
        });

        Schema::create('user_gift_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->longText('user_link');
            $table->string('code');
            $table->integer('amount')->nullable();

            $table->enum('status', ['pending', 'redeemed', 'expired'])->default('pending');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
};
