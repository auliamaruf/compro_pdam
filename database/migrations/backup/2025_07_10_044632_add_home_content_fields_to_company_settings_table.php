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
        Schema::table('company_settings', function (Blueprint $table) {
            // About Preview Section
            $table->string('about_preview_title')->nullable()->after('company_description');
            $table->text('about_preview_description')->nullable();
            $table->text('about_preview_content')->nullable();
            
            // Key Features (JSON array)
            $table->json('key_features')->nullable();
            
            // Quick Services (JSON array)
            $table->json('quick_services')->nullable();
            
            // Other dynamic content
            $table->string('stats_section_title')->nullable();
            $table->text('stats_section_description')->nullable();
            $table->string('services_section_title')->nullable();
            $table->text('services_section_description')->nullable();
            $table->string('news_section_title')->nullable();
            $table->text('news_section_description')->nullable();
            
            // Quick Actions Section
            $table->string('quick_actions_title')->nullable();
            $table->text('quick_actions_description')->nullable();
            $table->json('quick_actions_items')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn([
                'about_preview_title',
                'about_preview_description', 
                'about_preview_content',
                'key_features',
                'quick_services',
                'stats_section_title',
                'stats_section_description',
                'services_section_title',
                'services_section_description',
                'news_section_title',
                'news_section_description',
                'quick_actions_title',
                'quick_actions_description',
                'quick_actions_items'
            ]);
        });
    }
};
