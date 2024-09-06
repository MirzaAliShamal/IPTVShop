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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('card_holder_name')->nullable()->after('company_bank_bic');
            $table->string('card_number')->nullable()->after('card_holder_name');
            $table->string('card_expiry')->nullable()->after('card_number');
            $table->string('card_cvv')->nullable()->after('card_expiry');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('card_holder_name');
            $table->dropColumn('card_number');
            $table->dropColumn('card_expiry');
            $table->dropColumn('card_cvv');
        });
    }
};
