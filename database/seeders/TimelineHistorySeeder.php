<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanySetting;

class TimelineHistorySeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $company = CompanySetting::first();
        
        if ($company) {
            $sampleTimeline = [
                [
                    'year' => '1975',
                    'title' => 'Pendirian PDAM Tirta Perwira',
                    'description' => 'PDAM Tirta Perwira Purbalingga didirikan berdasarkan Peraturan Daerah sebagai perusahaan daerah yang bergerak di bidang penyediaan air minum.',
                    'icon' => 'fas fa-seedling',
                    'impact' => 'Memulai era baru pelayanan air bersih untuk masyarakat Purbalingga',
                    'image' => null
                ],
                [
                    'year' => '1980-1990',
                    'title' => 'Ekspansi Jaringan Distribusi',
                    'description' => 'Perluasan jaringan pipa distribusi ke berbagai kecamatan di Kabupaten Purbalingga dengan pembangunan instalasi pengolahan air yang lebih modern.',
                    'icon' => 'fas fa-rocket',
                    'achievement' => 'Berhasil melayani 15 kecamatan dengan kualitas air yang memenuhi standar kesehatan',
                    'image' => null
                ],
                [
                    'year' => '1995-2000',
                    'title' => 'Modernisasi Sistem Operasional',
                    'description' => 'Implementasi sistem manajemen modern, peningkatan kapasitas produksi, dan penggunaan teknologi terdepan dalam pengolahan air.',
                    'icon' => 'fas fa-chart-line',
                    'impact' => 'Peningkatan efisiensi operasional hingga 60% dan kualitas pelayanan yang lebih baik',
                    'image' => null
                ],
                [
                    'year' => '2005-2010',
                    'title' => 'Era Digitalisasi Pelayanan',
                    'description' => 'Penerapan sistem informasi customer service, billing system otomatis, dan layanan online untuk kemudahan pelanggan.',
                    'icon' => 'fas fa-lightbulb',
                    'achievement' => 'Menjadi PDAM pertama di Jawa Tengah yang menerapkan sistem billing online',
                    'image' => null
                ],
                [
                    'year' => '2015-2020',
                    'title' => 'Sustainable Water Management',
                    'description' => 'Komitmen pada pengelolaan air berkelanjutan dengan implementasi smart water meter dan program konservasi air.',
                    'icon' => 'fas fa-leaf',
                    'impact' => 'Pengurangan kehilangan air hingga 20% dan program edukasi konservasi untuk 50,000 rumah tangga',
                    'image' => null
                ],
                [
                    'year' => '2020-sekarang',
                    'title' => 'Smart Water Technology',
                    'description' => 'Adopsi teknologi IoT, AI untuk monitoring kualitas air real-time, dan aplikasi mobile untuk pelayanan terintegrasi.',
                    'icon' => 'fas fa-star',
                    'achievement' => 'Target Universal Water Access 2030 dan Zero Waste Operations dengan teknologi ramah lingkungan',
                    'image' => null
                ]
            ];

            $company->update([
                'history_timeline' => $sampleTimeline
            ]);

            $this->command->info('Sample timeline history berhasil ditambahkan!');
        } else {
            $this->command->error('Company setting tidak ditemukan. Jalankan CompanySettingSeeder terlebih dahulu.');
        }
    }
}
