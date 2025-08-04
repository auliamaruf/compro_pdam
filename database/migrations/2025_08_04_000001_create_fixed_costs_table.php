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
        Schema::create('fixed_costs', function (Blueprint $table) {
            $table->id();
            $table->string('category_name'); // Nama kategori (Rumah Tangga, Komersial, dll)
            $table->text('description')->nullable(); // Deskripsi kategori
            $table->decimal('monthly_cost', 10, 2)->default(0); // Biaya tetap bulanan
            $table->decimal('installation_cost', 10, 2)->default(0); // Biaya pemasangan
            $table->decimal('security_deposit', 10, 2)->default(0); // Uang jaminan
            $table->integer('minimum_usage')->default(0); // Pemakaian minimum (m³)
            $table->string('meter_size')->nullable(); // Ukuran meter
            $table->enum('connection_type', ['new', 'upgrade', 'replacement'])->default('new'); // Jenis sambungan
            $table->boolean('is_active')->default(true); // Status aktif
            $table->date('effective_date'); // Tanggal berlaku
            $table->text('notes')->nullable(); // Catatan tambahan
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixed_costs');
    }
};
