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
        Schema::table('post_profile_views', function (Blueprint $table) {
            $table->foreignId('post_id')->index()->constrained('posts');
            $table->foreignId('profile_id')->index()->constrained('profiles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_profile_views', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->dropForeign(['profile_id']);
            $table->dropColumn('post_id');
            $table->dropColumn('profile_id');
        });
    }
};
