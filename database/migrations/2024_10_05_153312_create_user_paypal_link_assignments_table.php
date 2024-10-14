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
        Schema::create('user_paypal_link_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pay_pal_multiple_id');
            $table->unsignedBigInteger('pay_pal_multiple_link_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pay_pal_multiple_id')->references('id')->on('pay_pal_multiples')->onDelete('cascade');
            $table->foreign('pay_pal_multiple_link_id')->references('id')->on('pay_pal_multiple_links')->onDelete('cascade');

            $table->unique(['user_id', 'pay_pal_multiple_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_paypal_link_assignments');
    }
};
