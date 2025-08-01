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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->text('title')->unique();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->foreignId('category_id')->index()->nullable()->constrained('categories');
            $table->foreignId('parent_id')->nullable()->constrained('posts');
            $table->foreignId('profile_id')->constrained('profiles');
            $table->unsignedBigInteger('views')->nullable();
            $table->date('published_at')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
