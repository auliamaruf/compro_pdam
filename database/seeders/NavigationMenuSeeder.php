<?php

namespace Database\Seeders;

use App\Models\NavigationMenu;
use Illuminate\Database\Seeder;

class NavigationMenuSeeder extends Seeder
{
    public function run()
    {
        // Menu Utama (Header)
        $mainMenus = [
            [
                'title' => 'Beranda',
                'url' => '/',
                'position' => 'main',
                'sort_order' => 1,
                'icon' => 'heroicon-o-home',
                'is_active' => true,
                'is_external' => false,
                'target' => '_self',
                'description' => 'Halaman utama website'
            ],
            [
                'title' => 'Tentang Kami',
                'url' => '/about',
                'position' => 'main',
                'sort_order' => 2,
                'icon' => 'heroicon-o-information-circle',
                'is_active' => true,
                'is_external' => false,
                'target' => '_self',
                'description' => 'Informasi tentang PDAM Tirta Perwira'
            ],
            [
                'title' => 'Layanan',
                'url' => '/services',
                'position' => 'main',
                'sort_order' => 3,
                'icon' => 'heroicon-o-wrench-screwdriver',
                'is_active' => true,
                'is_external' => false,
                'target' => '_self',
                'description' => 'Layanan yang tersedia'
            ],
            [
                'title' => 'Berita',
                'url' => '/news',
                'position' => 'main',
                'sort_order' => 4,
                'icon' => 'heroicon-o-newspaper',
                'is_active' => true,
                'is_external' => false,
                'target' => '_self',
                'description' => 'Berita dan pengumuman terbaru'
            ],
            [
                'title' => 'Kontak',
                'url' => '/contact',
                'position' => 'main',
                'sort_order' => 5,
                'icon' => 'heroicon-o-phone',
                'is_active' => true,
                'is_external' => false,
                'target' => '_self',
                'description' => 'Hubungi kami'
            ],
        ];

        foreach ($mainMenus as $menu) {
            NavigationMenu::create($menu);
        }

        // Sub-menu untuk Layanan
        $serviceParent = NavigationMenu::where('title', 'Layanan')->first();
        $serviceSubMenus = [
            [
                'title' => 'Sambungan Baru',
                'url' => '/services/sambungan-baru',
                'position' => 'main',
                'parent_id' => $serviceParent->id,
                'sort_order' => 1,
                'is_active' => true,
                'is_external' => false,
                'target' => '_self',
                'description' => 'Permohonan sambungan air baru'
            ],
            [
                'title' => 'Cek Tagihan',
                'url' => '/check-bill',
                'position' => 'main',
                'parent_id' => $serviceParent->id,
                'sort_order' => 2,
                'is_active' => true,
                'is_external' => false,
                'target' => '_self',
                'description' => 'Cek tagihan air online'
            ],
            [
                'title' => 'Pengaduan Online',
                'url' => '/services/pengaduan',
                'position' => 'main',
                'parent_id' => $serviceParent->id,
                'sort_order' => 3,
                'is_active' => true,
                'is_external' => false,
                'target' => '_self',
                'description' => 'Ajukan pengaduan online'
            ],
            [
                'title' => 'Tarif Air',
                'url' => '/tariff',
                'position' => 'main',
                'parent_id' => $serviceParent->id,
                'sort_order' => 4,
                'is_active' => true,
                'is_external' => false,
                'target' => '_self',
                'description' => 'Informasi tarif air'
            ],
        ];

        foreach ($serviceSubMenus as $menu) {
            NavigationMenu::create($menu);
        }

        // Menu Footer
        $footerMenus = [
            [
                'title' => 'Tentang Kami',
                'url' => '/about',
                'position' => 'footer',
                'sort_order' => 1,
                'is_active' => true,
                'is_external' => false,
                'target' => '_self'
            ],
            [
                'title' => 'Layanan',
                'url' => '/services',
                'position' => 'footer',
                'sort_order' => 2,
                'is_active' => true,
                'is_external' => false,
                'target' => '_self'
            ],
            [
                'title' => 'Berita',
                'url' => '/news',
                'position' => 'footer',
                'sort_order' => 3,
                'is_active' => true,
                'is_external' => false,
                'target' => '_self'
            ],
            [
                'title' => 'Tarif Air',
                'url' => '/tariff',
                'position' => 'footer',
                'sort_order' => 4,
                'is_active' => true,
                'is_external' => false,
                'target' => '_self'
            ],
            [
                'title' => 'Kontak',
                'url' => '/contact',
                'position' => 'footer',
                'sort_order' => 5,
                'is_active' => true,
                'is_external' => false,
                'target' => '_self'
            ],
        ];

        foreach ($footerMenus as $menu) {
            NavigationMenu::create($menu);
        }
    }
}
