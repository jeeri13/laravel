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
        Schema::table('user_redeems', function (Blueprint $table) {
            // Add foreign key constraint to user_id field
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Add foreign key constraint to promo_id field
            $table->unsignedBigInteger('promo_id');
            $table->foreign('promo_id')->references('id')->on('promocodes')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_redeems', function (Blueprint $table) {
            // Remove foreign key constraint from user_id field
            $table->dropForeign(['user_id']);

            // Remove foreign key constraint from promo_id field
            $table->dropForeign(['promo_id']);
        });
    }
};
