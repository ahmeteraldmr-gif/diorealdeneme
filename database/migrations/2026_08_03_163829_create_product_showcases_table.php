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
        Schema::create('product_showcases', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->json('eye')->nullable();
            $table->json('title')->nullable();
            $table->json('text')->nullable();
            $table->json('btn_text')->nullable();
            $table->string('btn_link')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_showcases');
    }
};
