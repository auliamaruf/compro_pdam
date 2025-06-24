<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MediaGallery;

class MediaGallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Fasilitas Pengolahan Air',
                'description' => 'Dokumentasi fasilitas pengolahan air modern milik PDAM Purbalingga',
                'category' => 'facilities',
                'sort_order' => 1,
                'is_featured' => true,
                'is_active' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Infrastruktur Distribusi',
                'description' => 'Jaringan pipa distribusi air bersih ke seluruh wilayah Purbalingga',
                'category' => 'infrastructure',
                'sort_order' => 2,
                'is_featured' => true,
                'is_active' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Kegiatan Pelayanan Masyarakat',
                'description' => 'Dokumentasi kegiatan pelayanan dan edukasi kepada masyarakat',
                'category' => 'activities',
                'sort_order' => 3,
                'is_featured' => false,
                'is_active' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Kantor Pusat PDAM',
                'description' => 'Gedung kantor pusat PDAM Tirta Perwira Purbalingga',
                'category' => 'facilities',
                'sort_order' => 4,
                'is_featured' => false,
                'is_active' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Program CSR Lingkungan',
                'description' => 'Kegiatan Corporate Social Responsibility bidang lingkungan',
                'category' => 'community',
                'sort_order' => 5,
                'is_featured' => true,
                'is_active' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Laboratorium Kualitas Air',
                'description' => 'Fasilitas laboratorium untuk pengujian kualitas air',
                'category' => 'facilities',
                'sort_order' => 6,
                'is_featured' => false,
                'is_active' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Tim Teknis Lapangan',
                'description' => 'Tim teknis yang siap melayani kebutuhan distribusi air',
                'category' => 'activities',
                'sort_order' => 7,
                'is_featured' => false,
                'is_active' => true,
                'published_at' => now(),
            ],
            [
                'title' => 'Reservoar Air Bersih',
                'description' => 'Tangki penampungan air bersih berkapasitas besar',
                'category' => 'infrastructure',
                'sort_order' => 8,
                'is_featured' => false,
                'is_active' => true,
                'published_at' => now(),
            ],
        ];

        foreach ($galleries as $gallery) {
            MediaGallery::create($gallery);
        }
    }
}
