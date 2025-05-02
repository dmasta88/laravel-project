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
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('second_name');
            $table->string('third_name')->nullable();
            $table->string('avatar')->nullable();
            $table->string('city')->nullable();
            $table->string('login');
            $table->foreignId('user_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn('second_name');
            $table->dropColumn('third_name');
            $table->dropColumn('avatar');
            $table->dropColumn('city');
            $table->dropColumn('login');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
