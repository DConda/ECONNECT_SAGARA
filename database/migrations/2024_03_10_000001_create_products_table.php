<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('unit');
            $table->string('main_image');
            $table->json('additional_images')->nullable();
            $table->foreignId('seller_id')->constrained('users');
            $table->string('category');
            $table->json('variants')->nullable();
            $table->integer('stock')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}; 