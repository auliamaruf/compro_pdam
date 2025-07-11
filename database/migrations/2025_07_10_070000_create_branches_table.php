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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama cabang
            $table->string('code')->unique(); // Kode cabang (contoh: CBG-001)
            $table->text('address'); // Alamat lengkap cabang
            $table->string('phone')->nullable(); // Telepon cabang
            $table->string('email')->nullable(); // Email cabang
            $table->decimal('latitude', 10, 8)->nullable(); // Koordinat latitude
            $table->decimal('longitude', 11, 8)->nullable(); // Koordinat longitude
            
            // Kepala cabang akan diambil dari organization_structures
            $table->unsignedBigInteger('head_of_branch_id')->nullable(); // ID dari organization_structures
            
            // Operasional
            $table->json('office_hours')->nullable(); // Jam operasional cabang
            $table->text('description')->nullable(); // Deskripsi cabang
            $table->json('services')->nullable(); // Layanan yang tersedia di cabang ini
            
            // Coverage area
            $table->json('coverage_areas')->nullable(); // Area yang dilayani cabang
            
            // Status
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0); // Urutan tampilan
            
            $table->timestamps();
            
            // Foreign key constraint
            $table->foreign('head_of_branch_id')->references('id')->on('organization_structures')->onDelete('set null');
            
            // Indexes
            $table->index('is_active');
            $table->index('sort_order');
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
