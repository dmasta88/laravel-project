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
        Schema::table('messages', function (Blueprint $table) {
            $table->text('content')->index();
            $table->foreignId('profile_id')->index()->constrained('profiles');
            $table->foreignId('chat_id')->index()->constrained('chats');
            $table->dateTime('published_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('content');
            $table->dropForeign(['profile_id']);
            $table->dropColumn('profile_id');
            $table->dropForeign(['chat_id']);
            $table->dropColumn('chat_id');
            $table->dropColumn('published_at');
        });
    }
};
