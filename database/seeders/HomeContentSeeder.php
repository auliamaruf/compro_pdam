<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanySetting;

class HomeContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $company = CompanySetting::first();
        
        if ($company) {
            $company->update([
                // About Preview Section
                'about_preview_title' => 'PDAM Tirta Perwira Purbalingga',
                'about_preview_description' => 'Perusahaan Daerah Air Minum yang telah dipercaya masyarakat Purbalingga selama lebih dari 50 tahun',
                'about_preview_content' => '<p><strong>PDAM Tirta Perwira</strong> telah mengabdi kepada masyarakat Purbalingga selama lebih dari 50 tahun dalam menyediakan air bersih berkualitas. Kami berkomitmen melayani dengan hati dan memberikan pelayanan terbaik.</p><p>Dengan teknologi modern dan SDM yang kompeten, kami terus berinovasi untuk meningkatkan kualitas pelayanan. Saat ini kami melayani lebih dari <strong>150.000 pelanggan</strong> di seluruh Kabupaten Purbalingga.</p><p>Visi kami adalah menjadi perusahaan air minum terdepan yang memberikan pelayanan prima dan berkontribusi pada pembangunan daerah yang berkelanjutan.</p>',
                
                // Key Features
                'key_features' => [
                    [
                        'title' => 'Air Berkualitas Tinggi',
                        'icon' => 'w-5 h-5 text-blue-600',
                        'bg_color' => 'bg-blue-100',
                        'icon_color' => 'text-blue-600'
                    ],
                    [
                        'title' => 'Pelayanan 24/7',
                        'icon' => 'w-5 h-5 text-green-600',
                        'bg_color' => 'bg-green-100',
                        'icon_color' => 'text-green-600'
                    ],
                    [
                        'title' => '150K+ Pelanggan',
                        'icon' => 'w-5 h-5 text-cyan-600',
                        'bg_color' => 'bg-cyan-100',
                        'icon_color' => 'text-cyan-600'
                    ],
                    [
                        'title' => 'Teknologi Terdepan',
                        'icon' => 'w-5 h-5 text-yellow-600',
                        'bg_color' => 'bg-yellow-100',
                        'icon_color' => 'text-yellow-600'
                    ],
                    [
                        'title' => '99% Kualitas Air',
                        'icon' => 'w-5 h-5 text-emerald-600',
                        'bg_color' => 'bg-emerald-100',
                        'icon_color' => 'text-emerald-600'
                    ]
                ],
                
                // Quick Services
                'quick_services' => [
                    [
                        'title' => 'Cek Tagihan',
                        'description' => 'Cek tagihan air bulanan Anda secara online dengan mudah',
                        'url' => 'https://tagihan.pdampurbalingga.co.id/',
                        'bg_color' => 'bg-blue-600',
                        'hover_color' => 'text-blue-600',
                        'external_link' => true
                    ],
                    [
                        'title' => 'Pengaduan Online',
                        'description' => 'Sampaikan keluhan atau saran Anda secara online',
                        'url' => 'https://pengaduan.pdampurbalingga.co.id/',
                        'bg_color' => 'bg-red-600',
                        'hover_color' => 'text-red-600',
                        'external_link' => true
                    ]
                ],
                
                // Section Titles & Descriptions
                'stats_section_title' => 'Prestasi Kami',
                'stats_section_description' => 'Komitmen nyata dalam memberikan pelayanan air bersih berkualitas untuk masyarakat Purbalingga',
                'services_section_title' => 'Layanan Utama',
                'services_section_description' => 'Kami menyediakan berbagai layanan air bersih berkualitas untuk memenuhi kebutuhan masyarakat Purbalingga',
                'news_section_title' => 'Berita Terkini',
                'news_section_description' => 'Dapatkan informasi terbaru seputar pelayanan dan perkembangan PDAM Purbalingga',
                
                // Quick Actions
                'quick_actions_title' => 'Hubungi Kami',
                'quick_actions_description' => 'Kami siap melayani Anda 24/7. Hubungi kami melalui berbagai channel yang tersedia.',
                'quick_actions_items' => [
                    [
                        'title' => 'Call Center',
                        'description' => 'Hubungi call center kami',
                        'url' => 'tel:(0281) 895062',
                        'icon' => 'heroicon-o-phone',
                        'type' => 'phone'
                    ],
                    [
                        'title' => 'WhatsApp',
                        'description' => 'Chat langsung via WhatsApp',
                        'url' => 'https://wa.me/6282133445566',
                        'icon' => 'heroicon-o-chat-bubble-left-right',
                        'type' => 'whatsapp'
                    ],
                    [
                        'title' => 'Email',
                        'description' => 'Kirim email ke kami',
                        'url' => 'mailto:info@pdamtirtaperwira.com',
                        'icon' => 'heroicon-o-envelope',
                        'type' => 'email'
                    ]
                ]
            ]);
        }
    }
}
