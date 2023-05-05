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
        Schema::table('users', function (Blueprint $bp) {
            $bp->dropColumn('name');
            $bp->text('firstname');
            $bp->text('lastname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $bp) {
            $bp->string('name');
            if (Schema::hasColumn('users', 'firstname'))
            {
                $bp->dropColumn('firstname');
            }
            if (Schema::hasColumn('users', 'lastname'))
            {
                $bp->dropColumn('lastname');
            }
        });
    }
};
