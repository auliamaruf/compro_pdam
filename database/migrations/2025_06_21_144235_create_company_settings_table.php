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
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('company_tagline')->nullable();

            // Logo & Branding
            $table->string('logo')->nullable();
            $table->string('logo_white')->nullable();
            $table->string('favicon')->nullable();
            $table->string('primary_color')->default('#2563eb');
            $table->string('secondary_color')->default('#1e40af');
            $table->text('brand_description')->nullable();

            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('whatsapp_cs')->nullable();
            $table->text('about_us')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();

            // Hero Section (Legacy - for backward compatibility)
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_cta_primary')->nullable();
            $table->string('hero_cta_secondary')->nullable();
            $table->text('hero_description')->nullable();

            // Hero Slides (New - Multiple slides support)
            $table->json('hero_slides')->nullable();

            // About Us - Company Profile
            $table->text('company_description')->nullable();
            $table->text('company_history')->nullable();
            $table->json('company_values')->nullable(); // Array of company values
            $table->json('milestones')->nullable(); // Company milestones/achievements

            // About Us - History
            $table->json('history_timeline')->nullable(); // Timeline data
            $table->json('achievements')->nullable(); // Key achievements with metrics
            $table->text('legacy_description')->nullable();

            // About Us - Vision & Mission
            $table->text('vision_description')->nullable(); // Detailed vision explanation
            $table->json('mission_points')->nullable(); // Array of mission statements
            $table->json('core_values')->nullable(); // Core company values with descriptions

            // About Us - Organization
            $table->text('organization_structure_description')->nullable(); // Organization description
            $table->json('organization_structure')->nullable(); // Org chart data
            $table->json('leadership_team')->nullable(); // Leadership profiles
            $table->json('organizational_culture')->nullable(); // Culture values

            // Statistics & Metrics
            $table->integer('years_experience')->nullable();
            $table->integer('customers_served')->nullable();
            $table->decimal('water_quality_percentage', 5, 2)->nullable();
            $table->string('service_availability')->nullable(); // e.g., "24/7"

            $table->string('accent_color')->default('#10B981');
            $table->json('social_media')->nullable(); // Facebook, Instagram, Twitter links
            $table->json('office_hours')->nullable(); // Operating hours
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
