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
        Schema::create('log_events', function (Blueprint $table) {
            $table->id();
            $table->string('event_type');
            $table->text('sql_query');
            $table->double('time');
            $table->foreignId('log_request_id')->constrained('log_requests');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_events');
    }
};
