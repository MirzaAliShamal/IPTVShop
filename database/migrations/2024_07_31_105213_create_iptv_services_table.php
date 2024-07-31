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
        Schema::create('iptv_services', function (Blueprint $table) {
            $table->id();
            $table->enum('connection_type', ['single', 'multi']);
            $table->enum('duration', [1, 3, 6, 12]);
            $table->text('logo')->nullable();
            $table->string('title');
            $table->integer('price')->default(0);
            $table->string('short_desc');
            $table->text('description');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iptv_services');
    }
};
