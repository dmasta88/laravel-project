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
        Schema::table('comments', function (Blueprint $table) {
            $table->morphs('commentable');
            $table->foreignId('profile_id')->index()->constrained('profiles');
            $table->text('content');
            $table->dateTime('published_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropMorphs('commentable');
            $table->dropForeign(['profile_id']);
            $table->dropColumn('profile_id');
            $table->dropColumn('content');
            $table->dropColumn('published_at');
        });
    }
};
