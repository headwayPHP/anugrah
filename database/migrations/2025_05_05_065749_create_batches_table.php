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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->string('batch_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('day_of_week')->nullable(); // e.g., "Monday,Wednesday,Friday"
            $table->string('time')->nullable(); // e.g., "10:00 AM - 12:00 PM"
            $table->string('mode')->nullable(); // Online/Offline/Hybrid
            $table->string('location')->nullable(); // For offline batches
            $table->enum('status', ['0', '1'])->default('1'); // 1 = active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
