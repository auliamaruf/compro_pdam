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
            CompanySettingSeeder::class,
            NewsSeeder::class,
            ServiceSeeder::class,
            WaterTariffSeeder::class,
            PageSeeder::class,
            CommentSeeder::class,
            MediaSeeder::class,
        ]);
    }
}
