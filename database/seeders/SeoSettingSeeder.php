<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SeoSetting;

class SeoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Global SEO Settings
        SeoSetting::updateOrCreate(
            ['page_type' => 'global'],
            [
                'meta_title' => 'PDAM Tirta Perwira Purbalingga - Air Bersih untuk Kehidupan yang Lebih Baik',
                'meta_description' => 'PDAM Tirta Perwira Purbalingga menyediakan layanan air bersih berkualitas tinggi untuk masyarakat Kabupaten Purbalingga dengan teknologi modern dan pelayanan prima 24/7.',
                'meta_keywords' => ['PDAM Purbalingga', 'air bersih', 'Tirta Perwira', 'layanan air', 'tagihan air', 'pengaduan online', 'air minum', 'PDAM Jawa Tengah'],
                'og_title' => 'PDAM Tirta Perwira Purbalingga - Melayani dengan Hati',
                'og_description' => 'Layanan air bersih berkualitas tinggi untuk masyarakat Purbalingga dengan teknologi modern dan pelayanan prima 24/7.',
                'og_image' => '/images/og-image.jpg',
                'twitter_title' => 'PDAM Tirta Perwira Purbalingga',
                'twitter_description' => 'Air bersih berkualitas tinggi untuk kehidupan yang lebih baik di Purbalingga.',
                'canonical_url' => 'https://pdamtirtaperwira.co.id',
                'robots' => 'index,follow',
                'schema_markup' => [
                    '@context' => 'https://schema.org',
                    '@type' => 'Organization',
                    'name' => 'PDAM Tirta Perwira Purbalingga',
                    'description' => 'Perusahaan Daerah Air Minum Purbalingga'
                ]
            ]
        );

        // Homepage SEO
        SeoSetting::updateOrCreate(
            ['page_type' => 'home'],
            [
                'meta_title' => 'Beranda - PDAM Tirta Perwira Purbalingga',
                'meta_description' => 'Selamat datang di website resmi PDAM Tirta Perwira Purbalingga. Dapatkan informasi layanan air bersih, cek tagihan online, dan pengaduan pelanggan.',
                'meta_keywords' => ['beranda PDAM', 'cek tagihan air', 'pengaduan online', 'layanan pelanggan', 'air bersih Purbalingga'],
                'og_title' => 'PDAM Tirta Perwira Purbalingga - Melayani dengan Hati',
                'og_description' => 'Website resmi PDAM Tirta Perwira Purbalingga. Cek tagihan, layanan pelanggan, dan informasi air bersih berkualitas.',
                'robots' => 'index,follow'
            ]
        );

        // About Us SEO
        SeoSetting::updateOrCreate(
            ['page_type' => 'about'],
            [
                'meta_title' => 'Tentang Kami - PDAM Tirta Perwira Purbalingga',
                'meta_description' => 'Mengenal lebih dekat PDAM Tirta Perwira Purbalingga. Sejarah, visi misi, dan komitmen melayani masyarakat Purbalingga sejak 1975.',
                'meta_keywords' => ['tentang PDAM', 'sejarah PDAM', 'visi misi', 'profil perusahaan', 'Tirta Perwira'],
                'og_title' => 'Tentang PDAM Tirta Perwira Purbalingga',
                'og_description' => 'Perusahaan daerah air minum yang telah melayani masyarakat Purbalingga sejak 1975 dengan komitmen pelayanan prima.',
                'robots' => 'index,follow'
            ]
        );

        // Services SEO
        SeoSetting::updateOrCreate(
            ['page_type' => 'services'],
            [
                'meta_title' => 'Layanan - PDAM Tirta Perwira Purbalingga',
                'meta_description' => 'Berbagai layanan PDAM Tirta Perwira: pemasangan sambungan baru, perbaikan meter, cek tagihan online, dan layanan pelanggan 24/7.',
                'meta_keywords' => ['layanan PDAM', 'sambungan air baru', 'perbaikan meter', 'cek tagihan', 'layanan pelanggan'],
                'og_title' => 'Layanan PDAM Tirta Perwira Purbalingga',
                'og_description' => 'Layanan lengkap air bersih: sambungan baru, perbaikan, tagihan online, dan customer service 24/7.',
                'robots' => 'index,follow'
            ]
        );

        // News SEO
        SeoSetting::updateOrCreate(
            ['page_type' => 'news'],
            [
                'meta_title' => 'Berita - PDAM Tirta Perwira Purbalingga',
                'meta_description' => 'Berita terkini dan informasi terbaru seputar layanan air bersih, pengumuman, dan kegiatan PDAM Tirta Perwira Purbalingga.',
                'meta_keywords' => ['berita PDAM', 'pengumuman', 'informasi terbaru', 'kegiatan PDAM', 'update layanan'],
                'og_title' => 'Berita PDAM Tirta Perwira Purbalingga',
                'og_description' => 'Informasi terkini dan berita seputar layanan air bersih PDAM Tirta Perwira Purbalingga.',
                'robots' => 'index,follow'
            ]
        );

        // Contact SEO
        SeoSetting::updateOrCreate(
            ['page_type' => 'contact'],
            [
                'meta_title' => 'Kontak - PDAM Tirta Perwira Purbalingga',
                'meta_description' => 'Hubungi PDAM Tirta Perwira Purbalingga. Alamat kantor, telepon, email, WhatsApp customer service, dan jam operasional.',
                'meta_keywords' => ['kontak PDAM', 'alamat kantor', 'telepon', 'email', 'WhatsApp', 'customer service', 'jam buka'],
                'og_title' => 'Kontak PDAM Tirta Perwira Purbalingga',
                'og_description' => 'Hubungi kami untuk informasi layanan air bersih. Customer service 24/7 siap melayani Anda.',
                'robots' => 'index,follow'
            ]
        );

        // Tariff SEO
        SeoSetting::updateOrCreate(
            ['page_type' => 'tariff'],
            [
                'meta_title' => 'Tarif Air - PDAM Tirta Perwira Purbalingga',
                'meta_description' => 'Daftar tarif air bersih dan biaya tetap PDAM Tirta Perwira Purbalingga untuk berbagai kategori pelanggan. Tarif resmi terbaru.',
                'meta_keywords' => ['tarif air', 'biaya air', 'harga air PDAM', 'tarif resmi', 'biaya tetap', 'kategori pelanggan'],
                'og_title' => 'Tarif Air PDAM Tirta Perwira Purbalingga',
                'og_description' => 'Informasi lengkap tarif air bersih dan biaya tetap untuk semua kategori pelanggan PDAM Tirta Perwira.',
                'robots' => 'index,follow'
            ]
        );
    }
}
