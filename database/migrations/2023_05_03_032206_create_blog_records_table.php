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
        Schema::create('blog_records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('title');
            $table->text('image_path')->nullable(true);
            $table->text('body_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_records');
    }
};
