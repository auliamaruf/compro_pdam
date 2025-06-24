<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\CompanySetting::create([
            'company_name' => 'Perumda Air Minum Tirta Perwira',
            'company_tagline' => 'Air Bersih Untuk Kehidupan Yang Lebih Baik',

            // Logo & Branding (akan diupload melalui admin panel)
            'logo' => null,
            'logo_white' => null,
            'favicon' => null,
            'primary_color' => '#2563eb',
            'secondary_color' => '#1e40af',
            'brand_description' => 'Perumda Air Minum Tirta Perwira adalah perusahaan daerah yang berkomitmen memberikan layanan air bersih berkualitas tinggi untuk masyarakat Kabupaten Purbalingga dengan standar pelayanan prima dan berwawasan lingkungan.',

            'address' => 'Jl. Jenderal Ahmad Yani No. 123, Purbalingga, Jawa Tengah 53316',
            'phone' => '(0281) 891-234',
            'email' => 'info@tirtaperwira.purbalinggakab.go.id',
            'website' => 'https://tirtaperwira.purbalinggakab.go.id',
            'emergency_phone' => '(0281) 891-999',
            'whatsapp_cs' => '0812-1234-5678',
            'about_us' => 'Perumda Air Minum Tirta Perwira adalah Perusahaan Umum Daerah yang bergerak dalam bidang penyediaan air bersih untuk masyarakat Kabupaten Purbalingga.',
            'vision' => 'Menjadi perusahaan air minum terdepan di Jawa Tengah yang memberikan pelayanan prima, berkelanjutan, dan berwawasan lingkungan untuk kesejahteraan masyarakat.',
            'mission' => 'Menyediakan air bersih berkualitas tinggi yang memenuhi standar kesehatan dan keamanan. Memberikan pelayanan prima dan responsif kepada seluruh pelanggan.',

            // Hero Section
            'hero_title' => "Melayani dengan\nHati",
            'hero_subtitle' => 'Memberikan yang terbaik untuk air bersih berkualitas bagi masyarakat Purbalingga',
            'hero_cta_primary' => 'Layanan Kami',
            'hero_cta_secondary' => 'Cek Tagihan',
            'hero_description' => 'PDAM Tirta Perwira siap melayani kebutuhan air bersih Anda dengan standar kualitas terbaik',

            // Hero Slides (Multiple slides)
            'hero_slides' => [
                [
                    'title' => 'Melayani dengan Hati',
                    'subtitle' => 'Memberikan yang terbaik untuk air bersih berkualitas bagi masyarakat Purbalingga',
                    'description' => 'PDAM Tirta Perwira siap melayani kebutuhan air bersih Anda dengan standar kualitas terbaik',
                    'primary_cta_text' => 'Layanan Kami',
                    'primary_cta_link' => '/layanan',
                    'secondary_cta_text' => 'Cek Tagihan',
                    'secondary_cta_link' => '/cek-tagihan',
                    'background_image' => null,
                    'text_position' => 'left',
                    'overlay_color' => '#1e3a8a',
                    'overlay_opacity' => 80,
                    'is_active' => true,
                ],
                [
                    'title' => 'Air Bersih, Hidup Sehat',
                    'subtitle' => 'Kualitas air terbaik dengan teknologi modern dan pelayanan 24 jam',
                    'description' => 'Telah melayani lebih dari 150.000 pelanggan di seluruh Kabupaten Purbalingga',
                    'primary_cta_text' => 'Tentang Kami',
                    'primary_cta_link' => '/tentang',
                    'secondary_cta_text' => 'Kontak',
                    'secondary_cta_link' => '/kontak',
                    'background_image' => null,
                    'text_position' => 'center',
                    'overlay_color' => '#0891b2',
                    'overlay_opacity' => 75,
                    'is_active' => true,
                ],
                [
                    'title' => 'Teknologi Modern',
                    'subtitle' => 'Sistem pengolahan air canggih untuk menjamin kualitas dan keamanan',
                    'description' => 'Dengan standar internasional dan sertifikasi ISO 9001:2015',
                    'primary_cta_text' => 'Sambungan Baru',
                    'primary_cta_link' => '/layanan/sambungan-baru',
                    'secondary_cta_text' => 'Pengaduan',
                    'secondary_cta_link' => '/pengaduan-online',
                    'background_image' => null,
                    'text_position' => 'right',
                    'overlay_color' => '#059669',
                    'overlay_opacity' => 70,
                    'is_active' => true,
                ],
            ],

            // About Us - Company Profile
            'company_description' => '<p>Perumda Air Minum Tirta Perwira adalah Perusahaan Umum Daerah yang bergerak dalam bidang penyediaan air bersih untuk masyarakat Kabupaten Purbalingga. Didirikan pada tahun 1982, kami telah melayani lebih dari 150.000 pelanggan di seluruh wilayah Kabupaten Purbalingga.</p><p>Dengan komitmen tinggi terhadap kualitas dan pelayanan, PDAM Tirta Perwira terus melakukan modernisasi infrastruktur dan peningkatan kualitas sumber daya manusia untuk memberikan pelayanan air bersih yang berkualitas, aman, dan terjangkau bagi seluruh masyarakat.</p>',
            'company_history' => '<p>PDAM Tirta Perwira didirikan pada tahun 1982 sebagai bagian dari upaya pemerintah daerah untuk menyediakan akses air bersih bagi masyarakat Kabupaten Purbalingga. Sejak awal berdiri, perusahaan telah mengalami berbagai perkembangan dan modernisasi untuk meningkatkan kualitas pelayanan.</p>',
            'company_values' => [
                ['title' => 'Integritas', 'description' => 'Berpegang teguh pada kejujuran, transparansi, dan akuntabilitas dalam setiap tindakan dan keputusan'],
                ['title' => 'Pelayanan Prima', 'description' => 'Memberikan pelayanan terbaik dengan mengutamakan kepuasan dan kepentingan pelanggan'],
                ['title' => 'Inovasi', 'description' => 'Terus mengembangkan dan menerapkan teknologi serta metode terdepan dalam pengelolaan air'],
                ['title' => 'Keberlanjutan', 'description' => 'Mengelola sumber daya air dengan memperhatikan kelestarian lingkungan untuk generasi mendatang']
            ],
            'milestones' => [
                ['year' => 1982, 'title' => 'Pendirian PDAM', 'description' => 'Berdiri sebagai Perusahaan Daerah Air Minum Tirta Perwira'],
                ['year' => 1990, 'title' => 'Ekspansi Pertama', 'description' => 'Perluasan jaringan ke 5 kecamatan utama'],
                ['year' => 2000, 'title' => 'Modernisasi Sistem', 'description' => 'Implementasi teknologi pengolahan air modern'],
                ['year' => 2015, 'title' => 'Era Digital', 'description' => 'Peluncuran sistem pembayaran online dan customer service digital'],
                ['year' => 2020, 'title' => 'Sertifikasi ISO', 'description' => 'Memperoleh sertifikasi ISO 9001:2015 untuk manajemen kualitas']
            ],

            // About Us - History
            'history_timeline' => [
                ['period' => '1970-an', 'title' => 'Awal Mula Berdiri', 'description' => 'PDAM Tirta Perwira Purbalingga didirikan sebagai bagian dari upaya pemerintah daerah untuk menyediakan akses air bersih bagi masyarakat Kabupaten Purbalingga.'],
                ['period' => '1980-an', 'title' => 'Pengembangan Infrastruktur', 'description' => 'Pembangunan instalasi pengolahan air pertama dan perluasan jaringan distribusi untuk menjangkau lebih banyak wilayah di Purbalingga.'],
                ['period' => '1990-an', 'title' => 'Modernisasi Sistem', 'description' => 'Implementasi teknologi modern dalam pengolahan air dan sistem manajemen, meningkatkan kualitas pelayanan kepada masyarakat.'],
                ['period' => '2000-an', 'title' => 'Ekspansi Wilayah Layanan', 'description' => 'Perluasan cakupan layanan ke seluruh kecamatan di Kabupaten Purbalingga dengan peningkatan kapasitas produksi air bersih.'],
                ['period' => '2010-an', 'title' => 'Era Digital dan Inovasi', 'description' => 'Implementasi sistem digital untuk pembayaran, monitoring kualitas air, dan pelayanan online untuk meningkatkan kepuasan pelanggan.'],
                ['period' => '2020 - Sekarang', 'title' => 'Komitmen Berkelanjutan', 'description' => 'Terus berinovasi dengan teknologi terdepan, program ramah lingkungan, dan pelayanan prima untuk mewujudkan air bersih berkualitas bagi semua.']
            ],
            'achievements' => [
                ['metric' => '50+', 'label' => 'Tahun Pengalaman', 'icon' => 'heroicon-o-building-office'],
                ['metric' => '150K+', 'label' => 'Pelanggan Dilayani', 'icon' => 'heroicon-o-users'],
                ['metric' => '99%', 'label' => 'Kualitas Air Terjamin', 'icon' => 'heroicon-o-check-circle'],
                ['metric' => '24/7', 'label' => 'Pelayanan Siaga', 'icon' => 'heroicon-o-bolt']
            ],
            'legacy_description' => '<p>Dengan pengalaman puluhan tahun, PDAM Tirta Perwira terus berkomitmen memberikan pelayanan terbaik dan berkontribusi dalam pembangunan Kabupaten Purbalingga yang berkelanjutan.</p>',

            // About Us - Vision & Mission
            'vision_description' => '<p>Menjadi perusahaan daerah air minum yang terdepan di Jawa Tengah dalam memberikan pelayanan air bersih berkualitas, berkelanjutan, dan terjangkau untuk meningkatkan kualitas hidup masyarakat Purbalingga.</p>',
            'mission_points' => [
                ['title' => 'Penyediaan Air Berkualitas', 'description' => 'Menyediakan air bersih yang memenuhi standar kesehatan dan kualitas nasional dengan sistem pengolahan yang modern dan terpercaya.'],
                ['title' => 'Pelayanan Prima', 'description' => 'Memberikan pelayanan yang responsif, profesional, dan berorientasi pada kepuasan pelanggan dengan dukungan teknologi digital.'],
                ['title' => 'Pengembangan Infrastruktur', 'description' => 'Mengembangkan infrastruktur distribusi air yang merata dan berkelanjutan untuk menjangkau seluruh wilayah Purbalingga.'],
                ['title' => 'Konservasi Sumber Daya', 'description' => 'Mengelola sumber daya air secara berkelanjutan dengan program konservasi dan perlindungan lingkungan yang bertanggung jawab.'],
                ['title' => 'Manajemen Profesional', 'description' => 'Menerapkan tata kelola perusahaan yang baik, transparan, dan akuntabel dengan sumber daya manusia yang kompeten.'],
                ['title' => 'Inovasi Berkelanjutan', 'description' => 'Mengembangkan inovasi teknologi dan sistem pelayanan untuk meningkatkan efisiensi dan kualitas layanan secara berkelanjutan.']
            ],
            'core_values' => [
                ['name' => 'PEDULI', 'description' => 'Mengutamakan kepentingan masyarakat dan lingkungan dalam setiap pengambilan keputusan dan tindakan.', 'icon' => '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>'],
                ['name' => 'AMANAH', 'description' => 'Menjalankan tugas dan tanggung jawab dengan penuh integritas, kejujuran, dan dapat dipercaya.', 'icon' => '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>'],
                ['name' => 'INOVATIF', 'description' => 'Senantiasa mencari cara-cara baru yang lebih baik dalam memberikan pelayanan dan mengelola sumber daya.', 'icon' => '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>'],
                ['name' => 'PROFESIONAL', 'description' => 'Bekerja dengan standar keahlian tinggi, disiplin, dan komitmen terhadap hasil yang berkualitas.', 'icon' => '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>'],
                ['name' => 'BERKELANJUTAN', 'description' => 'Mengelola bisnis dengan mempertimbangkan dampak jangka panjang terhadap lingkungan dan generasi mendatang.', 'icon' => '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 002 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"></path></svg>'],
                ['name' => 'EKONOMIS', 'description' => 'Mengelola sumber daya secara efisien dan efektif untuk memberikan nilai terbaik kepada pelanggan dan stakeholder.', 'icon' => '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path></svg>']
            ],

            // About Us - Organization
            'organization_structure_description' => 'Struktur organisasi PDAM Tirta Perwira dirancang untuk memberikan pelayanan yang efektif dan efisien kepada masyarakat dengan pembagian tugas dan tanggung jawab yang jelas pada setiap tingkatan.',
            'organization_structure' => [
                // Level 1 - Top Management
                [
                    [
                        'title' => 'Direktur Utama',
                        'name' => 'Sugeng S.T.',
                        'subtitle' => 'Chief Executive Officer',
                        'description' => 'Pemimpin tertinggi organisasi yang bertanggung jawab atas keseluruhan operasional perusahaan',
                        'icon' => '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
                        'color' => 'blue'
                    ]
                ],
                // Level 2 - Directors
                [
                    [
                        'title' => 'Direktur Umum',
                        'name' => 'H. Baryono, S.H.',
                        'subtitle' => 'General Director',
                        'description' => 'Mengelola sumber daya manusia, administrasi umum, dan hubungan masyarakat',
                        'icon' => '<svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>',
                        'color' => 'green'
                    ]
                ],
                // Level 3 - Department Heads (di bawah Direktur)
                [
                    [
                        'title' => 'Kepala Bagian Umum',
                        'name' => 'Endah Susilowati, S.H.',
                        'subtitle' => 'Head of General Affairs',
                        'description' => 'Mengelola administrasi umum, kepegawaian, dan pelayanan internal',
                        'icon' => '<svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>',
                        'color' => 'purple'
                    ],
                    [
                        'title' => 'Kepala Bagian Teknik',
                        'name' => 'Widi Asmoko, S.T.',
                        'subtitle' => 'Head of Technical Department',
                        'description' => 'Bertanggung jawab atas operasional teknis dan infrastruktur',
                        'icon' => '<svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>',
                        'color' => 'orange'
                    ],
                    [
                        'title' => 'Kepala Bagian Hubungan Langganan',
                        'name' => 'Triyono',
                        'subtitle' => 'Head of Customer Relations',
                        'description' => 'Mengelola hubungan pelanggan dan pelayanan publik',
                        'icon' => '<svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>',
                        'color' => 'cyan'
                    ],
                    [
                        'title' => 'Kepala Bagian SPI',
                        'name' => 'Wagiman, S.T',
                        'subtitle' => 'Head of Internal Audit',
                        'description' => 'Sistem Pengendalian Internal dan audit organisasi',
                        'icon' => '<svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>',
                        'color' => 'red'
                    ]
                ],
                // Level 4 - Sub-Department Heads under Bagian Umum
                [
                    [
                        'title' => 'Kepala Sub Bagian Kepegawaian',
                        'name' => 'Yuni Nurhayah',
                        'subtitle' => 'Head of Personnel Sub-Department',
                        'description' => 'Pengelolaan SDM dan administrasi kepegawaian',
                        'icon' => '<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>',
                        'color' => 'blue'
                    ],
                    [
                        'title' => 'Kepala Sub Bagian Kerumahtanggaan',
                        'name' => 'Irawan Tri Desi, S.T.',
                        'subtitle' => 'Head of General Services Sub-Department',
                        'description' => 'Pengelolaan fasilitas dan layanan umum',
                        'icon' => '<svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4"></path></svg>',
                        'color' => 'green'
                    ],
                    [
                        'title' => 'Kepala Sub Bagian Hukum dan Humas',
                        'name' => 'Anggrian Wedha P, S.H.',
                        'subtitle' => 'Head of Legal & Public Relations Sub-Department',
                        'description' => 'Penanganan aspek hukum dan hubungan masyarakat',
                        'icon' => '<svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>',
                        'color' => 'purple'
                    ],
                    [
                        'title' => 'Kepala Sub Bagian Kesekretariatan dan Kearsipan',
                        'name' => 'Susi Herawati',
                        'subtitle' => 'Head of Secretariat & Archives Sub-Department',
                        'description' => 'Pengelolaan administrasi dan kearsipan organisasi',
                        'icon' => '<svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>',
                        'color' => 'yellow'
                    ],
                    [
                        'title' => 'Kepala Sub Bagian Informasi dan Teknologi',
                        'name' => 'M. Manshur Kholiq, S.T.',
                        'subtitle' => 'Head of IT Sub-Department',
                        'description' => 'Pengelolaan sistem informasi dan teknologi',
                        'icon' => '<svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>',
                        'color' => 'indigo'
                    ]
                ],
                // Level 5 - Sub-Department Heads under Bagian Teknik
                [
                    [
                        'title' => 'Kepala Sub Bagian Perencanaan',
                        'name' => 'Sugeng, A.Md.',
                        'subtitle' => 'Head of Planning Sub-Department',
                        'description' => 'Perencanaan pengembangan infrastruktur dan proyeksi kebutuhan',
                        'icon' => '<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>',
                        'color' => 'blue'
                    ],
                    [
                        'title' => 'Kepala Sub Bagian NRW dan GIS',
                        'name' => 'Santoso, A.Md.',
                        'subtitle' => 'Head of NRW & GIS Sub-Department',
                        'description' => 'Non-Revenue Water management dan Geographic Information System',
                        'icon' => '<svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>',
                        'color' => 'green'
                    ],
                    [
                        'title' => 'Kepala Sub Bagian Produksi',
                        'name' => 'Supandi',
                        'subtitle' => 'Head of Production Sub-Department',
                        'description' => 'Pengolahan dan produksi air bersih',
                        'icon' => '<svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>',
                        'color' => 'purple'
                    ],
                    [
                        'title' => 'Kepala Sub Bagian Transmisi dan Distribusi',
                        'name' => 'Sopandi',
                        'subtitle' => 'Head of Transmission & Distribution Sub-Department',
                        'description' => 'Pengelolaan jaringan transmisi dan distribusi air',
                        'icon' => '<svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>',
                        'color' => 'orange'
                    ]
                ],
                // Level 6 - Sub-Department Heads under Bagian Hubungan Langganan
                [
                    [
                        'title' => 'Kepala Sub Bagian Pelayanan Pelanggan',
                        'name' => 'Imam Toni Prasetyo, S.Kom',
                        'subtitle' => 'Head of Customer Service Sub-Department',
                        'description' => 'Pelayanan prima kepada pelanggan dan penanganan keluhan',
                        'icon' => '<svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>',
                        'color' => 'blue'
                    ],
                    [
                        'title' => 'Kepala Sub Bagian Bacameter',
                        'name' => 'Agung Cahyadi, A.Md.',
                        'subtitle' => 'Head of Meter Reading Sub-Department',
                        'description' => 'Pembacaan meter dan pengelolaan data konsumsi air',
                        'icon' => '<svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>',
                        'color' => 'green'
                    ],
                    [
                        'title' => 'Kepala Sub Bagian Pemasaran',
                        'name' => 'Berliana Diah Lestari',
                        'subtitle' => 'Head of Marketing Sub-Department',
                        'description' => 'Strategi pemasaran dan pengembangan layanan baru',
                        'icon' => '<svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>',
                        'color' => 'purple'
                    ]
                ]
            ],
            'leadership_team' => [
                [
                    'name' => 'Sugeng S.T.',
                    'position' => 'Direktur Utama',
                    'description' => 'Memimpin perusahaan dengan visi strategis dan komitmen tinggi terhadap pelayanan prima kepada masyarakat Purbalingga. Berpengalaman dalam pengembangan infrastruktur air bersih dan manajemen perusahaan daerah.',
                    'qualifications' => [
                        'Pengalaman 15+ tahun di industri air bersih',
                        'Sarjana Teknik dengan spesialisasi infrastruktur',
                        'Sertifikasi Manajemen Perusahaan Daerah'
                    ]
                ],
                [
                    'name' => 'H. Baryono, S.H.',
                    'position' => 'Direktur Umum',
                    'description' => 'Bertanggung jawab mengelola sumber daya manusia, administrasi umum, dan hubungan masyarakat. Memastikan operasional perusahaan berjalan dengan efektif dan efisien.',
                    'qualifications' => [
                        'Sarjana Hukum dengan pengalaman 12+ tahun',
                        'Ahli dalam manajemen SDM dan administrasi',
                        'Sertifikasi Kepemimpinan dan Manajemen Publik'
                    ]
                ],
                [
                    'name' => 'Widi Asmoko, S.T.',
                    'position' => 'Kepala Bagian Teknik',
                    'description' => 'Mengelola seluruh aspek teknis operasional PDAM mulai dari pengolahan air, distribusi, hingga pemeliharaan infrastruktur dengan standar kualitas tinggi.',
                    'qualifications' => [
                        'Sarjana Teknik dengan spesialisasi Air dan Lingkungan',
                        'Pengalaman 10+ tahun di bidang teknik air',
                        'Sertifikasi Manajemen Kualitas Air dan ISO 9001'
                    ]
                ]
            ],
            'organizational_culture' => [
                ['name' => 'Integritas', 'description' => 'Kejujuran dan transparansi dalam setiap tindakan', 'icon' => 'heroicon-o-shield-check'],
                ['name' => 'Inovasi', 'description' => 'Terus mencari cara baru untuk meningkatkan pelayanan', 'icon' => 'heroicon-o-light-bulb'],
                ['name' => 'Kerjasama', 'description' => 'Sinergitas tim untuk mencapai tujuan bersama', 'icon' => 'heroicon-o-users'],
                ['name' => 'Dedikasi', 'description' => 'Komitmen penuh untuk melayani masyarakat', 'icon' => 'heroicon-o-heart']
            ],

            // Statistics & Metrics
            'years_experience' => 50,
            'customers_served' => 150000,
            'water_quality_percentage' => 99.00,
            'service_availability' => '24/7',

            'accent_color' => '#10B981',
            'social_media' => [
                'facebook' => 'https://facebook.com/tirtaperwira.purbalingga',
                'instagram' => 'https://instagram.com/tirtaperwira_official',
                'twitter' => 'https://twitter.com/tirtaperwira',
                'youtube' => 'https://youtube.com/@tirtaperwira',
                'linkedin' => 'https://linkedin.com/company/pdam-tirta-perwira'
            ],
            'office_hours' => [
                'senin_jumat' => '07:30 - 16:00 WIB',
                'sabtu' => '07:30 - 12:00 WIB',
                'minggu' => 'Tutup',
                'emergency' => '24 Jam (Call Center)',
                'holiday' => 'Sesuai kalender nasional'
            ],
            'is_active' => true
        ]);
    }
}
