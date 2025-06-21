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
        Schema::table('posts', function (Blueprint $table) {
            $table->text('title');
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->foreignId('category_id')->index()->nullable()->constrained('categories');
            $table->foreignId('parent_id')->nullable()->constrained('posts');
            $table->unsignedBigInteger('views')->nullable();
            $table->date('published_at')->nullable();
            $table->boolean('is_active')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('content');
            $table->dropColumn('image')->nullable();
            $table->dropColumn('video')->nullable();
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->dropForeign(['parent_id']);
            $table->dropColumn('parent_id');
            $table->dropColumn('views');
            $table->dropColumn('published_at');
            $table->dropColumn('is_active');
        });
    }
};
