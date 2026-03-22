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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name', 45)->nullable();
            $table->string('class', 45)->nullable();
            $table->string('race', 45)->nullable();
            $table->string('background', 45)->nullable();
            $table->string('traits', 255)->nullable();
            $table->string('ideals', 255)->nullable();
            $table->string('attachments', 255)->nullable();
            $table->string('weaknesses', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
