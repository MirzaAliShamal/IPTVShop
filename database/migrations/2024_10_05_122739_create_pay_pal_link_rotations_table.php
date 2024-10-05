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
        Schema::create('pay_pal_link_rotations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pay_pal_multiple_id');
            $table->unsignedInteger('last_used_index')->nullable();

            $table->foreign('pay_pal_multiple_id')->references('id')->on('pay_pal_multiples')->onDelete('cascade');
            $table->unique('pay_pal_multiple_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pay_pal_link_rotations');
    }
};
