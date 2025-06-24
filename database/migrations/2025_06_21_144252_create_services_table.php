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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('icon')->nullable(); // Icon class or image path
            $table->enum('category', ['new_connection', 'customer_service', 'technical', 'billing', 'other'])->default('other');
            $table->json('requirements')->nullable(); // Array of requirements
            $table->string('process_time')->nullable(); // e.g., "3-5 hari kerja"
            $table->decimal('fee', 10, 2)->nullable(); // Service fee
            $table->text('procedure')->nullable(); // Step by step procedure
            $table->string('contact_person')->nullable();
            $table->string('contact_phone')->nullable();
            $table->json('forms')->nullable(); // Array of required forms/documents
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);

            // Navbar configuration
            $table->boolean('show_in_navbar')->default(false); // Show in main navbar
            $table->integer('navbar_order')->default(0); // Order in navbar
            $table->string('navbar_label')->nullable(); // Custom label for navbar (if different from name)
            $table->string('navbar_icon')->nullable(); // Icon for navbar dropdown
            $table->boolean('is_navbar_featured')->default(false); // Featured item in navbar dropdown

            $table->timestamps();

            $table->index(['category', 'is_active']);
            $table->index('sort_order');
            $table->index(['show_in_navbar', 'navbar_order']); // Index for navbar queries
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
