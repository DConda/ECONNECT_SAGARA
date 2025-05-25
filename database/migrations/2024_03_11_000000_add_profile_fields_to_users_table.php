<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->nullable()->after('email');
            $table->text('bio')->nullable()->after('avatar');
            $table->string('phone')->nullable()->after('bio');
            $table->string('address')->nullable()->after('phone');
            $table->date('birth_date')->nullable()->after('address');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('birth_date');
            $table->json('social_media')->nullable()->after('gender');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'avatar',
                'bio',
                'phone',
                'address',
                'birth_date',
                'gender',
                'social_media'
            ]);
        });
    }
}; 