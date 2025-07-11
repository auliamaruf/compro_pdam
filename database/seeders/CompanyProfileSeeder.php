<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyProfile;

class CompanyProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create company profile with default data
        CompanyProfile::updateOrCreate(
            ['is_active' => true],
            [
                'company_name' => 'Perumda Air Minum Tirta Perwira',
                'company_tagline' => 'Air Bersih Untuk Kehidupan Yang Lebih Baik',
                'address' => 'Jl. Jenderal Ahmad Yani No. 123, Purbalingga, Jawa Tengah 53316',
                'phone' => '(0281) 891-234',
                'email' => 'info@tirtaperwira.purbalinggakab.go.id',
                'website' => 'https://tirtaperwira.purbalinggakab.go.id',
                'emergency_phone' => '(0281) 891-999',
                'whatsapp_cs' => '0812-1234-5678',
                'about_us' => 'Perumda Air Minum Tirta Perwira adalah Perusahaan Umum Daerah yang bergerak dalam bidang penyediaan air bersih untuk masyarakat Kabupaten Purbalingga.',
                'vision' => 'Menjadi perusahaan air minum terdepan di Jawa Tengah yang memberikan pelayanan prima, berkelanjutan, dan berwawasan lingkungan untuk kesejahteraan masyarakat.',
                'mission' => 'Menyediakan air bersih berkualitas tinggi yang memenuhi standar kesehatan dan keamanan. Memberikan pelayanan prima dan responsif kepada seluruh pelanggan.',
                'company_description' => '<p>Perumda Air Minum Tirta Perwira adalah Perusahaan Umum Daerah yang bergerak dalam bidang penyediaan air bersih untuk masyarakat Kabupaten Purbalingga. Didirikan pada tahun 1982, kami telah melayani lebih dari 150.000 pelanggan di seluruh wilayah Kabupaten Purbalingga.</p>',
                'vision_description' => '<p>Menjadi perusahaan daerah air minum yang terdepan di Jawa Tengah dalam memberikan pelayanan air bersih berkualitas, berkelanjutan, dan terjangkau untuk meningkatkan kualitas hidup masyarakat Purbalingga.</p>',
                'mission_points' => [
                    ['title' => 'Penyediaan Air Berkualitas', 'description' => 'Menyediakan air bersih yang memenuhi standar kesehatan dan kualitas nasional dengan sistem pengolahan yang modern dan terpercaya.'],
                    ['title' => 'Pelayanan Prima', 'description' => 'Memberikan pelayanan yang responsif, profesional, dan berorientasi pada kepuasan pelanggan dengan dukungan teknologi digital.'],
                ],
                'core_values' => [
                    ['name' => 'PEDULI', 'description' => 'Mengutamakan kepentingan masyarakat dan lingkungan dalam setiap pengambilan keputusan dan tindakan.', 'icon' => 'heroicon-o-heart'],
                    ['name' => 'AMANAH', 'description' => 'Menjalankan tugas dan tanggung jawab dengan penuh integritas, kejujuran, dan dapat dipercaya.', 'icon' => 'heroicon-o-check-circle'],
                ],
                'social_media' => [
                    'facebook' => 'https://facebook.com/tirtaperwira.purbalingga',
                    'instagram' => 'https://instagram.com/tirtaperwira_official',
                    'twitter' => 'https://twitter.com/tirtaperwira',
                    'youtube' => 'https://youtube.com/@tirtaperwira',
                ],
                'office_hours' => [
                    'senin_jumat' => '07:30 - 16:00 WIB',
                    'sabtu' => '07:30 - 12:00 WIB',
                    'minggu' => 'Tutup',
                    'emergency' => '24 Jam (Call Center)',
                ],
                'is_active' => true
            ]
        );
    }
}
