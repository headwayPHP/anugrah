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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('student_id')->nullable()->constrained()->onDelete('set null');

            $table->date('attendance_date');
            $table->text('remarks')->nullable();
            $table->string('status', 45); // You can use ENUM or just strings like '0', '1' for absent/present
            $table->timestamps();

            $table->unique(['student_id', 'attendance_date'], 'unique_student_date'); // Prevent double entries per student per date
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
