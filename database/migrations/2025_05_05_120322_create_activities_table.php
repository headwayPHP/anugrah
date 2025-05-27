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
        Schema::create('activities', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('title', 255); // VARCHAR(255)
            $table->longText('content'); // LONGTEXT
            $table->string('is_featured', 45)->default('0'); // VARCHAR(45) (0,1)
            $table->string('featured_image', 255)->nullable(); // VARCHAR(255)
            $table->string('status', 45)->default('1'); // VARCHAR(45) (0,1)
            $table->timestamps(); // TIMESTAMP for created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
