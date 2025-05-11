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
        Schema::create('galeris', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->string('slug')->unique(); // Tambahkan slug untuk URL SEO-friendly
            $table->enum('jenis', ['kegiatan', 'prestasi', 'lainnya'])->default('kegiatan');
            $table->text('deskripsi')->nullable();
            $table->string('thumbnail'); // Ubah 'gambar' menjadi 'thumbnail' untuk lebih spesifik
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('is_published')->default(true); // Untuk mengontrol publikasi
            $table->timestamp('published_at')->nullable(); // Waktu publikasi
            $table->softDeletes(); // Untuk soft delete
            $table->timestamps();
            
            $table->index('jenis'); // Index untuk kolom yang sering di-filter
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeris');
    }
};
