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
        Schema::create('water_sources', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->decimal('production_capacity', 10, 2); // liter/detik
            $table->enum('status', ['active', 'inactive', 'maintenance'])->default('active');
            $table->enum('ownership', ['milik_sendiri', 'sewa', 'kerjasama'])->default('milik_sendiri');
            $table->text('distribution_area');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_sources');
    }
};
