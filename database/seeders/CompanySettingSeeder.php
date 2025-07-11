<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanySetting::updateOrCreate(
            ['id' => 1],
            [
                // Identitas Perusahaan
                'company_name' => 'PDAM Tirta Perwira',
                'company_tagline' => 'Air Bersih Untuk Kehidupan Yang Lebih Baik',
                'company_description' => '<p>Perumda Air Minum Tirta Perwira adalah perusahaan daerah yang bergerak dalam bidang penyediaan air bersih untuk masyarakat Kabupaten Purbalingga. Kami berkomitmen untuk memberikan pelayanan air bersih berkualitas tinggi dengan standar kesehatan yang ketat.</p><p>Dengan pengalaman puluhan tahun, kami terus berinovasi dalam meningkatkan kualitas pelayanan dan memperluas jangkauan distribusi air bersih untuk seluruh masyarakat Purbalingga.</p>',
                'vision' => 'Menjadi perusahaan air minum terdepan di Jawa Tengah yang memberikan pelayanan prima dan berkelanjutan',
                'mission' => 'Memberikan pelayanan air bersih berkualitas tinggi kepada masyarakat',
                'vision_description' => 'Visi kami adalah menjadi perusahaan air minum yang terdepan dengan standar pelayanan prima dan berkelanjutan.',
                'mission_points' => [
                    [
                        'title' => 'Penyediaan Air Berkualitas',
                        'description' => 'Menyediakan air bersih yang memenuhi standar kesehatan dan kualitas nasional dengan sistem pengolahan yang modern dan terpercaya.'
                    ],
                    [
                        'title' => 'Pelayanan Prima',
                        'description' => 'Memberikan pelayanan yang responsif, profesional, dan berorientasi pada kepuasan pelanggan dengan dukungan teknologi digital.'
                    ],
                    [
                        'title' => 'Infrastruktur Berkelanjutan',
                        'description' => 'Mengembangkan dan memelihara infrastruktur air bersih yang ramah lingkungan dan berkelanjutan untuk generasi mendatang.'
                    ],
                    [
                        'title' => 'Akses Merata',
                        'description' => 'Memperluas jangkauan pelayanan air bersih ke seluruh wilayah dengan tarif yang terjangkau dan berkeadilan.'
                    ]
                ],
                
                // Kontak
                'phone' => '0281-895123',
                'email' => 'info@pdamtirtaperwira.com',
                'whatsapp_cs' => '6281234567890',
                'address' => 'Jl. Letjen S. Parman No. 123, Purbalingga, Jawa Tengah 53311',
                'office_hours' => [
                    'senin_kamis' => '07:00 - 16:00',
                    'jumat' => '07:00 - 11:30',
                    'sabtu_minggu' => 'Tutup'
                ],
                
                // Hero Section
                'hero_title' => 'Melayani dengan\nHati',
                'hero_subtitle' => 'Memberikan yang terbaik untuk air bersih berkualitas bagi masyarakat Purbalingga',
                'hero_cta_primary' => 'Layanan Kami',
                'hero_cta_secondary' => 'Cek Tagihan',
                'hero_slides' => [
                    [
                        'title' => 'Pelayanan Air Bersih 24 Jam',
                        'subtitle' => 'Siap melayani kebutuhan air bersih Anda kapan saja dengan kualitas terjamin',
                        'description' => 'PDAM Tirta Perwira hadir untuk memenuhi kebutuhan air bersih masyarakat Purbalingga',
                        'background_image' => null,
                        'overlay_color' => '#1e3a8a',
                        'overlay_opacity' => 80,
                        'text_position' => 'left',
                        'primary_cta_text' => 'Layanan Kami',
                        'primary_cta_link' => '/layanan',
                        'secondary_cta_text' => 'Cek Tagihan',
                        'secondary_cta_link' => '/cek-tagihan',
                        'is_active' => true
                    ],
                    [
                        'title' => 'Kualitas Air Terjamin',
                        'subtitle' => 'Air bersih dengan standar kesehatan yang ketat dan teknologi modern',
                        'description' => 'Proses pengolahan air dengan teknologi terkini untuk menjamin kualitas terbaik',
                        'background_image' => null,
                        'overlay_color' => '#059669',
                        'overlay_opacity' => 80,
                        'text_position' => 'center',
                        'primary_cta_text' => 'Tentang Kami',
                        'primary_cta_link' => '/tentang',
                        'secondary_cta_text' => 'Kontak',
                        'secondary_cta_link' => '/kontak',
                        'is_active' => true
                    ]
                ],
                
                // Company History
                'company_history' => '<p>PDAM Tirta Perwira didirikan pada tahun 1985 dengan tujuan untuk menyediakan air bersih bagi masyarakat Kabupaten Purbalingga. Sejak berdiri, perusahaan ini terus berkembang dan meningkatkan kualitas pelayanannya.</p>',
                'history_timeline' => [
                    [
                        'year' => '1985',
                        'title' => 'Pendirian PDAM',
                        'description' => 'Didirikan untuk melayani kebutuhan air bersih masyarakat Purbalingga'
                    ],
                    [
                        'year' => '1995',
                        'title' => 'Ekspansi Jaringan',
                        'description' => 'Memperluas jaringan distribusi ke seluruh kecamatan'
                    ],
                    [
                        'year' => '2010',
                        'title' => 'Modernisasi Sistem',
                        'description' => 'Implementasi sistem modern dan teknologi terkini'
                    ],
                    [
                        'year' => '2020',
                        'title' => 'Layanan Digital',
                        'description' => 'Peluncuran layanan online dan aplikasi mobile'
                    ]
                ],
                'achievements' => [
                    [
                        'title' => 'ISO 9001:2015',
                        'description' => 'Sertifikat manajemen mutu internasional',
                        'year' => '2020'
                    ],
                    [
                        'title' => 'Penghargaan Pelayanan Prima',
                        'description' => 'Dari Pemerintah Daerah Jawa Tengah',
                        'year' => '2021'
                    ]
                ],
                
                // Statistik
                'years_experience' => 38,
                'customers_served' => 45000,
                'water_quality_percentage' => 99.8,
                'service_availability' => 95.5,
                
                // JSON Data
                'social_media' => [
                    'facebook' => 'https://facebook.com/pdamtirtaperwira',
                    'facebook_username' => '@pdamtirtaperwira',
                    'instagram' => 'https://instagram.com/pdamtirtaperwira',
                    'instagram_username' => '@pdamtirtaperwira',
                    'youtube' => 'https://youtube.com/@pdamtirtaperwira',
                    'youtube_username' => 'PDAM Tirta Perwira Official',
                    'twitter' => 'https://twitter.com/pdamtirtaperwira',
                    'twitter_username' => '@pdamtirtaperwira',
                    'whatsapp' => 'https://wa.me/6281234567890'
                ],
                'core_values' => [
                    [
                        'name' => 'Integritas',
                        'description' => 'Berkomitmen pada kejujuran dan transparansi dalam setiap tindakan',
                        'icon' => '<i class="fas fa-shield-alt"></i>'
                    ],
                    [
                        'name' => 'Profesionalisme',
                        'description' => 'Memberikan pelayanan terbaik dengan keahlian dan dedikasi tinggi',
                        'icon' => '<i class="fas fa-user-tie"></i>'
                    ],
                    [
                        'name' => 'Inovasi',
                        'description' => 'Terus mengembangkan teknologi dan metode pelayanan yang lebih baik',
                        'icon' => '<i class="fas fa-lightbulb"></i>'
                    ],
                    [
                        'name' => 'Kepedulian',
                        'description' => 'Mengutamakan kepentingan masyarakat dan lingkungan',
                        'icon' => '<i class="fas fa-heart"></i>'
                    ]
                ],
                
                // Status
                'is_active' => true
            ]
        );
    }
}
