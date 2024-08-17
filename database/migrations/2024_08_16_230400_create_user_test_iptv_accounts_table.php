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
        Schema::create('user_test_iptv_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('test_iptv_account_id');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('expired_at')->nullable();

            $table->enum('status', ['pending', 'started', 'expired', 'suspended'])->default('pending');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('test_iptv_account_id')->references('id')->on('test_iptv_accounts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_test_iptv_accounts');
    }
};
