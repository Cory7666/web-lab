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
        Schema::create('blog_record_comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('blog_record_id')
                ->foreign('blog_record_id')
                ->on('blog_records')
                ->reference('id')
                ->onDelete('cascade');
            $table->bigInteger('author_id')
                ->foreign('author_id')
                ->on('users')
                ->reference('id')
                ->onDelete('cascade');
            $table->text('body_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_comments');
    }
};
