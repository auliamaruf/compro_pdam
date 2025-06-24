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
        Schema::create('water_tariffs', function (Blueprint $table) {
            $table->id();
            $table->string('customer_type'); // Rumah Tangga, Usaha, Sosial, dll
            $table->string('description')->nullable();
            $table->integer('min_usage'); // Minimum m3
            $table->integer('max_usage')->nullable(); // Maximum m3, null for unlimited
            $table->decimal('rate_per_m3', 8, 2); // Rate per cubic meter
            $table->decimal('admin_fee', 8, 2)->default(0); // Monthly admin fee
            $table->decimal('maintenance_fee', 8, 2)->default(0); // Maintenance fee
            $table->date('effective_date'); // When this tariff becomes effective
            $table->date('expired_date')->nullable(); // When this tariff expires
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->text('notes')->nullable(); // Additional notes

            // Navbar configuration
            $table->boolean('show_in_navbar')->default(false); // Show in navbar dropdown
            $table->integer('navbar_order')->default(0); // Order in navbar
            $table->string('navbar_label')->nullable(); // Custom navbar label
            $table->string('navbar_icon')->nullable(); // Icon for navbar
            $table->boolean('is_navbar_featured')->default(false); // Featured in navbar

            $table->timestamps();

            $table->index(['customer_type', 'is_active']);
            $table->index(['effective_date', 'expired_date']);
            $table->index(['show_in_navbar', 'navbar_order']); // For navbar queries
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_tariffs');
    }
};
