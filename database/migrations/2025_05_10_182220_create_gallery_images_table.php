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
        Schema::create('galeri_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('galeri_id')->constrained()->onDelete('cascade');
            $table->string('path');
            $table->string('original_name');
            $table->string('mime_type')->nullable();
            $table->unsignedInteger('size'); // Dalam bytes
            $table->unsignedInteger('width')->nullable(); // Dimensi gambar
            $table->unsignedInteger('height')->nullable(); // Dimensi gambar
            $table->integer('order')->default(0); // Untuk mengurutkan gambar
            $table->text('caption')->nullable();
            $table->timestamps();
            
            $table->index('galeri_id');
            $table->index('order');
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_images');
    }
};
