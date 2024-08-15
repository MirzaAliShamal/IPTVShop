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
        Schema::table('users', function (Blueprint $table) {
            $table->text('address')->nullable()->after('wallet_balance');
            $table->text('zipcode')->nullable()->after('address');
            $table->text('region')->nullable()->after('zipcode');
            $table->text('country')->nullable()->after('region');
            $table->text('city')->nullable()->after('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('zipcode');
            $table->dropColumn('region');
            $table->dropColumn('country');
            $table->dropColumn('city');
        });
    }
};
