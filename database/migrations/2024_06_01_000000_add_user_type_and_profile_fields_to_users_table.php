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
            $table->string('user_type')->default('buyer')->after('id'); // buyer, seller, admin
            $table->string('nickname')->nullable()->after('name');
            $table->string('profile_image')->nullable()->after('password');
            $table->text('biography')->nullable()->after('profile_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['user_type', 'nickname', 'profile_image', 'biography']);
        });
    }
};
