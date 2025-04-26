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
            $table->text('title')->unique()->index();
            $table->text('content');
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->foreignId('profile_id')->index()->constrained('profiles');
            //$table->foreignId('like_id')->nullable()->constrained('likes');
            $table->foreignId('category_id')->index()->nullable()->constrained('categories');
            $table->foreignId('parent_id')->nullable()->constrained('posts');
            //$table->foreign('tag_id')->nullable()->constrained('post_tag');
            $table->unsignedBigInteger('views')->nullable();
            $table->dateTime('published_at')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
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
