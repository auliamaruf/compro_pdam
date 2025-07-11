<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Air Bersih untuk Kehidupan yang Lebih Baik',
                'subtitle' => 'Pelayanan prima dengan teknologi modern untuk kebutuhan air bersih masyarakat Purbalingga',
                'description' => 'PDAM Tirta Perwira berkomitmen menyediakan air bersih berkualitas tinggi dengan harga terjangkau',
                'overlay_color' => '#1e3a8a',
                'overlay_opacity' => 80,
                'text_position' => 'left',
                'primary_cta_text' => 'Lihat Layanan',
                'primary_cta_link' => '/layanan',
                'secondary_cta_text' => 'Cek Tagihan',
                'secondary_cta_link' => '/cek-tagihan',
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Kualitas Air Terjamin',
                'subtitle' => 'Air bersih dengan standar kesehatan yang ketat dan teknologi modern',
                'description' => 'Proses pengolahan air dengan teknologi terkini untuk menjamin kualitas terbaik',
                'overlay_color' => '#059669',
                'overlay_opacity' => 80,
                'text_position' => 'center',
                'primary_cta_text' => 'Tentang Kami',
                'primary_cta_link' => '/tentang',
                'secondary_cta_text' => 'Kontak',
                'secondary_cta_link' => '/kontak',
                'sort_order' => 2,
                'is_active' => true
            ]
        ];

        foreach ($banners as $banner) {
            \App\Models\HeroBanner::create($banner);
        }
    }
}
