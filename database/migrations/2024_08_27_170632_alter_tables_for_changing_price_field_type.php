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
        Schema::table('funds_cards', function (Blueprint $table) {
            $table->float('amount')->change();
        });

        Schema::table('gift_cards', function (Blueprint $table) {
            $table->float('amount')->change();
        });

        Schema::table('iptv_services', function (Blueprint $table) {
            $table->float('price')->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->float('price')->change();
        });

        Schema::table('services', function (Blueprint $table) {
            $table->float('price')->change();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->float('amount')->change();
        });

        Schema::table('user_gift_cards', function (Blueprint $table) {
            $table->float('amount')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('funds_cards', function (Blueprint $table) {
            $table->integer('amount')->change();
        });

        Schema::table('gift_cards', function (Blueprint $table) {
            $table->integer('amount')->change();
        });

        Schema::table('iptv_services', function (Blueprint $table) {
            $table->integer('price')->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->integer('price')->change();
        });

        Schema::table('services', function (Blueprint $table) {
            $table->integer('price')->change();
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('amount')->change();
        });

        Schema::table('user_gift_cards', function (Blueprint $table) {
            $table->integer('amount')->change();
        });
    }
};
