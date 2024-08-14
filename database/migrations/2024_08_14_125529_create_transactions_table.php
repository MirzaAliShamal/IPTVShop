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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['giftcard', 'paypal', 'visa']);
            $table->integer('amount');
            $table->string('sender_paypal_email')->nullable();
            $table->string('company_paypal_email')->nullable();
            $table->string('sender_bank_iban')->nullable();
            $table->string('company_bank_name')->nullable();
            $table->string('company_bank_iban')->nullable();
            $table->string('company_bank_bic')->nullable();

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
        Schema::dropIfExists('transactions');
    }
};
