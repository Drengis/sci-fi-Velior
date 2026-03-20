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
            $table->string('name', 45);
            $table->string('class', 45);
            $table->string('race', 45);
            $table->string('background', 45);
            $table->string('traits', 255);
            $table->string('ideals', 255);
            $table->string('attachments', 255);
            $table->string('weaknesses', 255);
            $table->timestamps();
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
