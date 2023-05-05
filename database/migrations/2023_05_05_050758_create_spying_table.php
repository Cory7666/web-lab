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
        Schema::create('spying_records', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('path');
            $table->text('client_ip');
            $table->text('client_user_agent');
            $table->text('client_hostname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spying');
    }
};
