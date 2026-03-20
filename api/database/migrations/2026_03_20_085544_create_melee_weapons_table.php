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
        Schema::create('melee_weapons', function (Blueprint $table) {
            $table->id();
            $table->string('title', 45);
            $table->string('vs_MK1', 45);
            $table->string('vs_MK2', 45);
            $table->string('vs_MK3', 45);
            $table->string('vs_MK4', 45);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('melee_weapons');
    }
};
