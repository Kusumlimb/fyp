<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id(); 
            $table->string('title');  
            $table->text('description'); 
            $table->text('video_url')->nullable(); // Nullable to allow empty value until video is uploaded
            $table->foreignId('course_id')->constrained()->onDelete('cascade');  // Foreign key referencing courses table
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
