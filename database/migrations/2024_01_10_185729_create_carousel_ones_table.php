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
        Schema::create('carousel_ones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->constrained()->cascadeOnDelete();
            $table->string('image');
            $table->string('div_bg');
            $table->string('header');
            $table->string('header_color');
            $table->string('body_text');
            $table->string('body_text_color');
            $table->string('btn_text');
            $table->string('btn_color');
            $table->string('btn_bg');
            $table->string('url');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carousel_ones');
    }
};
