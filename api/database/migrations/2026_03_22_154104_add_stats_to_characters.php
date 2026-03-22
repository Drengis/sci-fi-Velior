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
        Schema::table('characters', function (Blueprint $table) {
            $table->integer('strength')->nullable()->default(10);
            $table->integer('dexterity')->nullable()->default(10);
            $table->integer('constitution')->nullable()->default(10);
            $table->integer('intelligence')->nullable()->default(10);
            $table->integer('wisdom')->nullable()->default(10);
            $table->integer('charisma')->nullable()->default(10);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('characters', function (Blueprint $table) {
            $table->dropColumn(['strength', 'dexterity', 'constitution', 'intelligence', 'wisdom', 'charisma']);
        });
    }
};
