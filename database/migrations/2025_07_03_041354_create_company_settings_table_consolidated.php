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
            
            // Identitas Perusahaan
            $table->string('company_name')->default('PDAM Tirta Perwira');
            $table->string('company_tagline')->nullable();
            $table->text('company_description')->nullable();
            
            // About Preview Section (from home content migration)
            $table->string('about_preview_title')->nullable();
            $table->text('about_preview_description')->nullable();
            $table->text('about_preview_content')->nullable();
            
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->text('vision_description')->nullable();
            $table->json('mission_points')->nullable(); // Array dari mission points
            
            // Kontak
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp_cs')->nullable();
            $table->text('address')->nullable();
            $table->json('office_hours')->nullable(); // Array dengan jam operasional
            
            // Media Files (untuk backward compatibility)
            $table->string('logo')->nullable();
            $table->string('logo_white')->nullable();
            $table->string('favicon')->nullable();
            
            // Hero Section
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_cta_primary')->nullable();
            $table->string('hero_cta_secondary')->nullable();
            $table->json('hero_slides')->nullable(); // Array dari hero slides
            
            // Company History
            $table->longText('company_history')->nullable();
            $table->json('history_timeline')->nullable(); // Array timeline sejarah (from history migration)
            $table->json('achievements')->nullable(); // Array pencapaian
            
            // Statistik (digunakan di frontend)
            $table->integer('years_experience')->nullable();
            $table->integer('customers_served')->nullable();
            $table->decimal('water_quality_percentage', 5, 2)->nullable();
            $table->decimal('service_availability', 5, 2)->nullable();
            
            // JSON Data
            $table->json('social_media')->nullable(); // facebook, instagram, youtube, twitter, whatsapp + usernames
            $table->json('core_values')->nullable(); // Array nilai-nilai perusahaan
            
            // Home Page Content (from home content migration)
            $table->json('key_features')->nullable();
            $table->json('quick_services')->nullable();
            $table->string('stats_section_title')->nullable();
            $table->text('stats_section_description')->nullable();
            $table->string('services_section_title')->nullable();
            $table->text('services_section_description')->nullable();
            $table->string('news_section_title')->nullable();
            $table->text('news_section_description')->nullable();
            $table->string('quick_actions_title')->nullable();
            $table->text('quick_actions_description')->nullable();
            $table->json('quick_actions_items')->nullable();
            
            // Status
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
            
            // Index untuk performa
            $table->index('is_active');
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
