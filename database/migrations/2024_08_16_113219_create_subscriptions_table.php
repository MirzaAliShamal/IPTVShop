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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['iptv', 'other']);
            $table->string('title')->nullable();
            $table->longText('details')->nullable();
            $table->string('duration')->nullable();
            $table->timestamp('order_placed_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('expired_at')->nullable();

            $table->enum('status', ['pending', 'started', 'expired', 'suspended'])->default('pending');

            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
