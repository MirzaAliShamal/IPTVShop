<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE transactions MODIFY COLUMN type ENUM('paypal', 'visa', 'wise')");
        DB::statement("ALTER TABLE `funds_cards` CHANGE `type` `type` ENUM('giftcard','paypal','visa') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL");
        DB::table('funds_cards')->where('type', 'giftcard')->update([
            'type' => null
        ]);
        DB::statement("ALTER TABLE funds_cards MODIFY COLUMN type ENUM('paypal', 'visa', 'wise')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE transactions MODIFY COLUMN type ENUM('giftcard', 'paypal', 'visa', 'wise')");
        DB::statement("ALTER TABLE funds_cards MODIFY COLUMN type ENUM('giftcard', 'paypal', 'visa')");
    }
};
