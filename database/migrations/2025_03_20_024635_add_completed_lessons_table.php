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
         Schema::create('completed_lessons', function (Blueprint $table) {
              $table->foreignId('user_id')->constrained()->onDelete('cascade');
              $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
              $table->primary(['lesson_id', 'user_id']);
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('completed_lessons');

    }
};
