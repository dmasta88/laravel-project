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
        Schema::create('follower_following', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')->constrained('profiles');
            $table->foreignId('following_id')->constrained('profiles');
            $table->unique(['follower_id', 'following_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follower_following');
    }
};
