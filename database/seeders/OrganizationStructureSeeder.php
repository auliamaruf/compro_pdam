<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks temporarily
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing data
        \App\Models\OrganizationStructure::truncate();
        
        // Re-enable foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $structures = [
            // Level 1 - Direktur Utama
            [
                'title' => 'Direktur Utama',
                'name' => 'Sugeng S.T.',
                'subtitle' => null,
                'description' => 'Memimpin operasional perusahaan secara keseluruhan',
                'icon' => '<i class="fas fa-crown"></i>',
                'level' => 1,
                'sort_order' => 1,
                'is_active' => true
            ],
            
            // Level 2 - Direktur Umum
            [
                'title' => 'Direktur Umum',
                'name' => 'H. Baryono, S.H.',
                'subtitle' => null,
                'description' => 'Mengelola administrasi dan operasional umum perusahaan',
                'icon' => '<i class="fas fa-user-tie"></i>',
                'level' => 2,
                'sort_order' => 1,
                'is_active' => true
            ],
            
            // Level 3 - Kepala Bagian
            [
                'title' => 'Kepala Bagian Umum',
                'name' => 'Endah Susilowati, S.H.',
                'subtitle' => null,
                'description' => 'Mengelola administrasi dan kepegawaian',
                'icon' => '<i class="fas fa-building"></i>',
                'level' => 3,
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Bagian Teknik',
                'name' => 'Widi Asmoko, S.T.',
                'subtitle' => null,
                'description' => 'Mengelola aspek teknis dan produksi',
                'icon' => '<i class="fas fa-cogs"></i>',
                'level' => 3,
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Bagian Hubungan Langganan',
                'name' => 'Triyono',
                'subtitle' => null,
                'description' => 'Mengelola hubungan dengan pelanggan',
                'icon' => '<i class="fas fa-users"></i>',
                'level' => 3,
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Bagian SPI',
                'name' => 'Wagiman, S.T',
                'subtitle' => null,
                'description' => 'Sistem Pengendalian Internal',
                'icon' => '<i class="fas fa-shield-alt"></i>',
                'level' => 3,
                'sort_order' => 4,
                'is_active' => true
            ],
            
            // Level 4 - Kepala Cabang
            [
                'title' => 'Kepala Cabang Kota',
                'name' => 'Tur Tjahjoto, S.ST.',
                'subtitle' => null,
                'description' => 'Mengelola cabang wilayah kota',
                'icon' => '<i class="fas fa-map-marker-alt"></i>',
                'level' => 4,
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Cabang Jenderal Soedirman',
                'name' => 'Sutarman, A.Md',
                'subtitle' => null,
                'description' => 'Mengelola cabang Jenderal Soedirman',
                'icon' => '<i class="fas fa-map-marker-alt"></i>',
                'level' => 4,
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Cabang Usman Janatin',
                'name' => 'Rakhmanto, S.ST.',
                'subtitle' => null,
                'description' => 'Mengelola cabang Usman Janatin',
                'icon' => '<i class="fas fa-map-marker-alt"></i>',
                'level' => 4,
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Cabang Goentoer Darjono',
                'name' => 'Adik Purwo S.',
                'subtitle' => null,
                'description' => 'Mengelola cabang Goentoer Darjono',
                'icon' => '<i class="fas fa-map-marker-alt"></i>',
                'level' => 4,
                'sort_order' => 4,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Cabang Ardilawet',
                'name' => 'Teguh Kuntjoro, S.ST',
                'subtitle' => null,
                'description' => 'Mengelola cabang Ardilawet',
                'icon' => '<i class="fas fa-map-marker-alt"></i>',
                'level' => 4,
                'sort_order' => 5,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Unit IKK Kemangkon',
                'name' => 'Maun Suseno, A.Md.',
                'subtitle' => null,
                'description' => 'Mengelola unit IKK Kemangkon',
                'icon' => '<i class="fas fa-building"></i>',
                'level' => 4,
                'sort_order' => 6,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Unit IKK Rembang',
                'name' => 'Margono',
                'subtitle' => null,
                'description' => 'Mengelola unit IKK Rembang',
                'icon' => '<i class="fas fa-building"></i>',
                'level' => 4,
                'sort_order' => 7,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Unit IKK Karangreja',
                'name' => 'Riyadi',
                'subtitle' => null,
                'description' => 'Mengelola unit IKK Karangreja',
                'icon' => '<i class="fas fa-building"></i>',
                'level' => 4,
                'sort_order' => 8,
                'is_active' => true
            ],
            
            // Level 5 - Sub Bagian Umum
            [
                'title' => 'Kepala Sub Bagian Kepegawaian',
                'name' => 'Yuni Nurhayah',
                'subtitle' => 'Bagian Umum',
                'description' => 'Mengelola kepegawaian dan SDM',
                'icon' => '<i class="fas fa-user-friends"></i>',
                'level' => 5,
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Sub Bagian Kerumahtanggaan',
                'name' => 'Irawan Tri Desi, S.T.',
                'subtitle' => 'Bagian Umum',
                'description' => 'Mengelola kerumahtanggaan dan logistik',
                'icon' => '<i class="fas fa-home"></i>',
                'level' => 5,
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Sub Bagian Hukum dan Humas',
                'name' => 'Anggrian Wedha P, S.H.',
                'subtitle' => 'Bagian Umum',
                'description' => 'Mengelola aspek hukum dan hubungan masyarakat',
                'icon' => '<i class="fas fa-gavel"></i>',
                'level' => 5,
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Sub Bagian Kesekretariatan dan Kearsipan',
                'name' => 'Susi Herawati',
                'subtitle' => 'Bagian Umum',
                'description' => 'Mengelola kesekretariatan dan kearsipan',
                'icon' => '<i class="fas fa-file-alt"></i>',
                'level' => 5,
                'sort_order' => 4,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Sub Bagian Informasi dan Teknologi',
                'name' => 'M. Manshur Kholiq, S.T.',
                'subtitle' => 'Bagian Umum',
                'description' => 'Mengelola sistem informasi dan teknologi',
                'icon' => '<i class="fas fa-laptop"></i>',
                'level' => 5,
                'sort_order' => 5,
                'is_active' => true
            ],
            
            // Level 6 - Sub Bagian Teknik
            [
                'title' => 'Kepala Sub Bagian Perencanaan',
                'name' => 'Sugeng, A.Md.',
                'subtitle' => 'Bagian Teknik',
                'description' => 'Mengelola perencanaan teknis',
                'icon' => '<i class="fas fa-drafting-compass"></i>',
                'level' => 6,
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Sub Bagian NRW dan GIS',
                'name' => 'Santoso, A.Md.',
                'subtitle' => 'Bagian Teknik',
                'description' => 'Mengelola Non Revenue Water dan GIS',
                'icon' => '<i class="fas fa-map"></i>',
                'level' => 6,
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Sub Bagian Produksi',
                'name' => 'Supandi',
                'subtitle' => 'Bagian Teknik',
                'description' => 'Mengelola produksi air bersih',
                'icon' => '<i class="fas fa-industry"></i>',
                'level' => 6,
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Sub Bagian Transmisi dan Distribusi',
                'name' => 'Sopandi',
                'subtitle' => 'Bagian Teknik',
                'description' => 'Mengelola transmisi dan distribusi',
                'icon' => '<i class="fas fa-share-alt"></i>',
                'level' => 6,
                'sort_order' => 4,
                'is_active' => true
            ],
            
            // Level 7 - Sub Bagian Hubungan Langganan
            [
                'title' => 'Kepala Sub Bagian Pelayanan Pelanggan',
                'name' => 'Imam Toni Prasetyo, S.Kom',
                'subtitle' => 'Bagian Hubungan Langganan',
                'description' => 'Mengelola pelayanan pelanggan',
                'icon' => '<i class="fas fa-headset"></i>',
                'level' => 7,
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Sub Bagian Bacameter',
                'name' => 'Agung Cahyadi, A.Md.',
                'subtitle' => 'Bagian Hubungan Langganan',
                'description' => 'Mengelola pembacaan meter',
                'icon' => '<i class="fas fa-tachometer-alt"></i>',
                'level' => 7,
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Kepala Sub Bagian Pemasaran',
                'name' => 'Berliana Diah Lestari',
                'subtitle' => 'Bagian Hubungan Langganan',
                'description' => 'Mengelola pemasaran dan promosi',
                'icon' => '<i class="fas fa-bullhorn"></i>',
                'level' => 7,
                'sort_order' => 3,
                'is_active' => true
            ]
        ];

        foreach ($structures as $structure) {
            \App\Models\OrganizationStructure::create($structure);
        }
    }
}
