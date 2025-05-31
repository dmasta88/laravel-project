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
        Schema::create('log_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->integer('select_count')->nullable()->default(0);
            $table->integer('insert_count')->nullable()->default(0);
            $table->integer('update_count')->nullable()->default(0);
            $table->integer('delete_count')->nullable()->default(0);
            $table->text('route')->nullable();
            $table->text('status')->nullable();
            $table->jsonb('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
