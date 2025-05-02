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
        Schema::table('likeables', function (Blueprint $table) {
            $table->morphs('likeable');
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('likeables', function (Blueprint $table) {
            $table->dropMorphs('likeable');
            $table->dropForeign(['profile_id']);
            $table->dropColumn('profile_id');
        });
    }
};
