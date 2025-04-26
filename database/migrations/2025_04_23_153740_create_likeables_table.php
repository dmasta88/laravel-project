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
        Schema::create('likeables', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->morphs('likeable');
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
            //$table->unique(['post_id', 'profile_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likeables');
    }
};
