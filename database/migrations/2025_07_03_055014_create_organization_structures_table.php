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
        Schema::create('organization_structures', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Jabatan
            $table->string('name')->nullable(); // Nama pejabat
            $table->string('subtitle')->nullable(); // Subtitle jabatan
            $table->text('description')->nullable(); // Deskripsi tugas
            $table->text('icon')->nullable(); // HTML icon
            $table->integer('level')->default(1); // Level hierarki (1=top, 2=middle, 3=bottom)
            $table->integer('sort_order')->default(0); // Urutan dalam level yang sama
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_structures');
    }
};
