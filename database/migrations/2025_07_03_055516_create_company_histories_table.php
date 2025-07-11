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
        Schema::create('company_histories', function (Blueprint $table) {
            $table->id();
            $table->string('year', 4); // Tahun kejadian
            $table->string('title'); // Judul peristiwa
            $table->text('description'); // Deskripsi peristiwa
            $table->text('detailed_content')->nullable(); // Konten detail yang lebih panjang
            $table->string('image')->nullable(); // Path gambar
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
        Schema::dropIfExists('company_histories');
    }
};
