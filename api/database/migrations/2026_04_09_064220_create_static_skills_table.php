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
        Schema::create('static_skills', function (Blueprint $table) {
            $table->id();
            $table->string('name', 45);
            $table->string('slug', 45);
            $table->string('ability', 45); // strength, dexterity, constitution, intelligence, wisdom, charisma
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('static_skills');
    }
};
