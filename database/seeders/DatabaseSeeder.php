<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin Tirta Perwira',
            'email' => 'aulia@pdampurbalingga.co.id',
            'password' => bcrypt('password'),
        ]);

                // Run seeders
        $this->call([
            CompanySettingSeeder::class,        // Company basic settings and configuration
            SeoSettingSeeder::class,           // SEO settings for all pages
            RoleSeeder::class,                 // User roles and permissions
            HomeContentSeeder::class,          // Home page specific content
            OrganizationStructureSeeder::class, // Organization structure
            BranchSeeder::class,               // Branch offices data
            CompanyHistorySeeder::class,       // Company history timeline
            NewsSeeder::class,                 // News articles
            ServiceSeeder::class,              // Services offered
            WaterTariffSeeder::class,          // Water tariff rates
            FixedCostSeeder::class,            // Fixed costs for customers
            CommentSeeder::class,              // Comments data
            MediaSeeder::class,                // Media files
            NavigationMenuSeeder::class,       // Navigation menu items
            TimelineHistorySeeder::class,      // Company timeline in settings (for legacy)
            HeroBannerSeeder::class,           // Hero banner slides
            PartnershipSeeder::class,          // Partnership data
            PageSeeder::class,                 // Static pages
            OnlineComplaintSeeder::class,      // Online complaint samples
        ]);
    }
}
