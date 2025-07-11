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
        Schema::create('hero_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul utama
            $table->string('subtitle')->nullable(); // Subtitle
            $table->text('description')->nullable(); // Deskripsi
            $table->string('background_image')->nullable(); // Path background image
            $table->string('overlay_color')->default('#1e3a8a'); // Warna overlay
            $table->integer('overlay_opacity')->default(80); // Transparansi overlay (0-100)
            $table->enum('text_position', ['left', 'center', 'right'])->default('left'); // Posisi teks
            $table->string('primary_cta_text')->nullable(); // Teks tombol utama
            $table->string('primary_cta_link')->nullable(); // Link tombol utama
            $table->string('secondary_cta_text')->nullable(); // Teks tombol kedua
            $table->string('secondary_cta_link')->nullable(); // Link tombol kedua
            $table->integer('sort_order')->default(0); // Urutan tampilan
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_banners');
    }
};
