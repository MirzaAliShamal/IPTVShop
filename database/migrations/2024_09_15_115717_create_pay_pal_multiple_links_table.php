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
        Schema::create('pay_pal_multiple_links', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->unsignedBigInteger('pay_pal_multiple_id');
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('pay_pal_multiple_id')->references('id')->on('pay_pal_multiples')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_pal_multiple_links');
    }
};
