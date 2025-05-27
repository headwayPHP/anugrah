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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();  // BIGINT AUTO_INCREMENT PRIMARY KEY
            $table->string('name', 255);
            $table->string('value', 255);
            $table->enum('status', [0, 1]);  // 0 = inactive, 1 = active
            $table->string('group', 255);
            $table->text('desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
