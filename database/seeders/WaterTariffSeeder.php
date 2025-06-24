<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WaterTariff;

class WaterTariffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        $tariffs = [
            // Rumah Tangga
            [
                'customer_type' => 'Rumah Tangga',
                'description' => 'Golongan I - Penggunaan 0 - 10 m³ per bulan',
                'min_usage' => 0,
                'max_usage' => 10,
                'rate_per_m3' => 3800,
                'admin_fee' => 2500,
                'maintenance_fee' => 3000,
                'is_active' => true,
                'effective_date' => '2025-08-01',
                'notes' => 'Tarif subsidi untuk penggunaan minimal rumah tangga',
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 1,
                'navbar_label' => 'Rumah Tangga (0-10m³)',
                'navbar_icon' => 'fas fa-home',
                'is_navbar_featured' => true,
            ],
            [
                'customer_type' => 'Rumah Tangga',
                'description' => 'Golongan II - Penggunaan 11 - 20 m³ per bulan',
                'min_usage' => 11,
                'max_usage' => 20,
                'rate_per_m3' => 4300,
                'admin_fee' => 2500,
                'maintenance_fee' => 3000,
                'is_active' => true,
                'effective_date' => '2025-08-01',
                'notes' => 'Tarif normal untuk penggunaan sedang rumah tangga',
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 2,
                'navbar_label' => 'Rumah Tangga (11-20m³)',
                'navbar_icon' => 'fas fa-home',
                'is_navbar_featured' => false,
            ],
            [
                'customer_type' => 'Rumah Tangga',
                'description' => 'Golongan III - Penggunaan 21 - 30 m³ per bulan',
                'min_usage' => 21,
                'max_usage' => 30,
                'rate_per_m3' => 5400,
                'admin_fee' => 2500,
                'maintenance_fee' => 3000,
                'is_active' => true,
                'effective_date' => '2025-08-01',
                'notes' => 'Tarif progresif untuk penggunaan tinggi rumah tangga',
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 3,
                'navbar_label' => 'Rumah Tangga (21-30m³)',
                'navbar_icon' => 'fas fa-home',
                'is_navbar_featured' => false,
            ],
            [
                'customer_type' => 'Rumah Tangga',
                'description' => 'Golongan IV - Penggunaan di atas 30 m³ per bulan',
                'min_usage' => 31,
                'max_usage' => null,
                'rate_per_m3' => 6200,
                'admin_fee' => 2500,
                'maintenance_fee' => 3000,
                'is_active' => true,
                'effective_date' => '2025-08-01',
                'notes' => 'Tarif tertinggi untuk penggunaan sangat tinggi rumah tangga',
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 4,
                'navbar_label' => 'Rumah Tangga (>30m³)',
                'navbar_icon' => 'fas fa-home',
                'is_navbar_featured' => false,
            ],

            // Komersial
            [
                'customer_type' => 'Komersial',
                'description' => 'Usaha Kecil - Toko, warung, salon, dan usaha sejenis',
                'min_usage' => 0,
                'max_usage' => 50,
                'rate_per_m3' => 8100,
                'admin_fee' => 3000,
                'maintenance_fee' => 5000,
                'is_active' => true,
                'effective_date' => '2025-08-01',
                'notes' => 'Untuk usaha komersial skala kecil',
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 5,
                'navbar_label' => 'Komersial Kecil',
                'navbar_icon' => 'fas fa-store',
                'is_navbar_featured' => true,
            ],
            [
                'customer_type' => 'Komersial',
                'description' => 'Usaha Menengah - Restoran, hotel kecil, perkantoran',
                'min_usage' => 51,
                'max_usage' => 200,
                'rate_per_m3' => 9500,
                'admin_fee' => 3500,
                'maintenance_fee' => 7000,
                'is_active' => true,
                'effective_date' => '2025-08-01',
                'notes' => 'Untuk usaha komersial skala menengah',
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 6,
                'navbar_label' => 'Komersial Menengah',
                'navbar_icon' => 'fas fa-building',
                'is_navbar_featured' => false,
            ],
            [
                'customer_type' => 'Komersial',
                'description' => 'Usaha Besar - Hotel, mall, perkantoran besar',
                'min_usage' => 201,
                'max_usage' => null,
                'rate_per_m3' => 11000,
                'admin_fee' => 5000,
                'maintenance_fee' => 10000,
                'is_active' => true,
                'effective_date' => '2025-08-01',
                'notes' => 'Untuk usaha komersial skala besar',
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 7,
                'navbar_label' => 'Komersial Besar',
                'navbar_icon' => 'fas fa-city',
                'is_navbar_featured' => false,
            ],

            // Industri
            [
                'customer_type' => 'Industri',
                'description' => 'Industri Kecil - Industri rumah tangga dan usaha kecil',
                'min_usage' => 0,
                'max_usage' => 100,
                'rate_per_m3' => 9200,
                'admin_fee' => 4000,
                'maintenance_fee' => 8000,
                'is_active' => true,
                'effective_date' => '2025-08-01',
                'notes' => 'Untuk industri skala kecil',
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 8,
                'navbar_label' => 'Industri Kecil',
                'navbar_icon' => 'fas fa-industry',
                'is_navbar_featured' => true,
            ],
            [
                'customer_type' => 'Industri',
                'description' => 'Industri Menengah - Industri pengolahan skala menengah',
                'min_usage' => 101,
                'max_usage' => 500,
                'rate_per_m3' => 10800,
                'admin_fee' => 6000,
                'maintenance_fee' => 15000,
                'is_active' => true,
                'effective_date' => '2025-08-01',
                'notes' => 'Untuk industri skala menengah',
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 9,
                'navbar_label' => 'Industri Menengah',
                'navbar_icon' => 'fas fa-industry',
                'is_navbar_featured' => false,
            ],
            [
                'customer_type' => 'Industri',
                'description' => 'Industri Besar - Industri pengolahan skala besar',
                'min_usage' => 501,
                'max_usage' => null,
                'rate_per_m3' => 12500,
                'admin_fee' => 10000,
                'maintenance_fee' => 25000,
                'is_active' => true,
                'effective_date' => '2025-08-01',
                'notes' => 'Untuk industri skala besar',
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 10,
                'navbar_label' => 'Industri Besar',
                'navbar_icon' => 'fas fa-industry',
                'is_navbar_featured' => false,
            ],

            // Sosial
            [
                'customer_type' => 'Sosial',
                'description' => 'Tempat Ibadah - Masjid, gereja, pura, vihara',
                'min_usage' => 0,
                'max_usage' => null,
                'rate_per_m3' => 3200,
                'admin_fee' => 2000,
                'maintenance_fee' => 2000,
                'is_active' => true,
                'effective_date' => '2025-08-01',
                'notes' => 'Tarif khusus untuk tempat ibadah',
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 11,
                'navbar_label' => 'Tempat Ibadah',
                'navbar_icon' => 'fas fa-pray',
                'is_navbar_featured' => false,
            ],
            [
                'customer_type' => 'Sosial',
                'description' => 'Pendidikan - Sekolah, universitas, perpustakaan',
                'min_usage' => 0,
                'max_usage' => null,
                'rate_per_m3' => 3500,
                'admin_fee' => 2000,
                'maintenance_fee' => 3000,
                'is_active' => true,
                'effective_date' => '2025-08-01',
                'notes' => 'Tarif khusus untuk institusi pendidikan',
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 12,
                'navbar_label' => 'Pendidikan',
                'navbar_icon' => 'fas fa-graduation-cap',
                'is_navbar_featured' => false,
            ],
            [
                'customer_type' => 'Sosial',
                'description' => 'Kesehatan - Rumah sakit, puskesmas, klinik',
                'min_usage' => 0,
                'max_usage' => null,
                'rate_per_m3' => 4000,
                'admin_fee' => 2500,
                'maintenance_fee' => 3500,
                'is_active' => true,
                'effective_date' => '2025-08-01',
                'notes' => 'Tarif khusus untuk fasilitas kesehatan',
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 13,
                'navbar_label' => 'Kesehatan',
                'navbar_icon' => 'fas fa-hospital',
                'is_navbar_featured' => false,
            ],

            // Instansi Pemerintah
            [
                'customer_type' => 'Instansi Pemerintah',
                'description' => 'Kantor Pemerintah - Kantor dinas, kelurahan, kecamatan',
                'min_usage' => 0,
                'max_usage' => null,
                'rate_per_m3' => 5500,
                'admin_fee' => 3000,
                'maintenance_fee' => 4000,
                'is_active' => true,
                'effective_date' => '2025-08-01',
                'notes' => 'Tarif untuk instansi pemerintah',
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 14,
                'navbar_label' => 'Instansi Pemerintah',
                'navbar_icon' => 'fas fa-landmark',
                'is_navbar_featured' => false,
            ],

            // Khusus
            [
                'customer_type' => 'Khusus',
                'description' => 'Hydrant Umum - Terminal air untuk umum',
                'min_usage' => 0,
                'max_usage' => null,
                'rate_per_m3' => 2500,
                'admin_fee' => 1000,
                'maintenance_fee' => 2000,
                'is_active' => true,
                'effective_date' => '2025-08-01',
                'notes' => 'Tarif khusus untuk hydrant umum',
                // Navbar configuration
                'show_in_navbar' => false, // Don't show in navbar
                'navbar_order' => 15,
                'navbar_label' => 'Hydrant Umum',
                'navbar_icon' => 'fas fa-fire-extinguisher',
                'is_navbar_featured' => false,
            ]
        ];

        foreach ($tariffs as $tariff) {
            WaterTariff::create($tariff);
        }
    }
}
