<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CompanyHistory;

class CompanyHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $histories = [
            [
                'year' => '1975',
                'title' => 'Pendirian PDAM Tirta Perwira',
                'description' => 'PDAM Tirta Perwira Purbalingga didirikan berdasarkan Peraturan Daerah sebagai perusahaan daerah yang bergerak di bidang penyediaan air minum.',
                'detailed_content' => '<p>Pada tahun 1975, Pemerintah Daerah Kabupaten Purbalingga mengeluarkan Peraturan Daerah untuk mendirikan Perusahaan Daerah Air Minum (PDAM) Tirta Perwira. Pendirian ini merupakan respons terhadap kebutuhan masyarakat akan akses air bersih yang layak dan terjangkau.</p><p>Dengan visi menjadi penyedia air bersih utama di wilayah Purbalingga, PDAM Tirta Perwira memulai operasionalnya dengan infrastruktur sederhana namun komitmen yang kuat untuk melayani masyarakat.</p>',
                'sort_order' => 1,
                'is_active' => true
            ],
            [
                'year' => '1980-1990',
                'title' => 'Ekspansi Jaringan Distribusi',
                'description' => 'Periode ekspansi besar-besaran jaringan pipa distribusi air ke seluruh kecamatan di Kabupaten Purbalingga.',
                'detailed_content' => '<p>Dekade 1980-1990 menjadi periode emas bagi PDAM Tirta Perwira dengan melakukan ekspansi jaringan distribusi secara massif. Program ini mencakup pembangunan jaringan pipa utama dan cabang yang menjangkau seluruh kecamatan di Kabupaten Purbalingga.</p><p>Ekspansi ini memungkinkan akses air bersih menjangkau daerah-daerah terpencil yang sebelumnya belum terlayani, meningkatkan kualitas hidup masyarakat secara signifikan.</p>',
                'sort_order' => 2,
                'is_active' => true
            ],
            [
                'year' => '2000',
                'title' => 'Modernisasi Sistem Pengolahan',
                'description' => 'Implementasi teknologi modern dalam sistem pengolahan air untuk meningkatkan kualitas dan efisiensi produksi.',
                'detailed_content' => '<p>Memasuki millennium baru, PDAM Tirta Perwira melakukan modernisasi sistem pengolahan air dengan mengadopsi teknologi terkini. Investasi ini mencakup peningkatan kapasitas produksi, sistem filtrasi canggih, dan implementasi sistem monitoring kualitas air real-time.</p><p>Modernisasi ini memastikan air yang diproduksi memenuhi standar kesehatan yang ditetapkan oleh Kementerian Kesehatan RI dan WHO.</p>',
                'sort_order' => 3,
                'is_active' => true
            ],
            [
                'year' => '2010',
                'title' => 'Sertifikasi ISO 9001:2008',
                'description' => 'Meraih sertifikasi ISO 9001:2008 sebagai bentuk komitmen terhadap standar kualitas internasional.',
                'detailed_content' => '<p>Pada tahun 2010, PDAM Tirta Perwira berhasil meraih sertifikasi ISO 9001:2008, menjadi salah satu PDAM pertama di Jawa Tengah yang memperoleh pengakuan standar kualitas internasional ini.</p><p>Sertifikasi ini mencerminkan komitmen perusahaan dalam memberikan pelayanan berkualitas tinggi dengan sistem manajemen yang terstandarisasi secara internasional.</p>',
                'sort_order' => 4,
                'is_active' => true
            ],
            [
                'year' => '2015',
                'title' => 'Digitalisasi Layanan Pelanggan',
                'description' => 'Peluncuran sistem informasi pelanggan dan layanan online untuk meningkatkan kualitas pelayanan.',
                'detailed_content' => '<p>Era digital mendorong PDAM Tirta Perwira untuk mengembangkan sistem informasi pelanggan yang terintegrasi. Layanan ini memungkinkan pelanggan untuk mengakses informasi tagihan, melakukan pembayaran online, dan mengajukan keluhan melalui platform digital.</p><p>Digitalisasi ini meningkatkan efisiensi operasional dan memberikan kemudahan akses bagi pelanggan dalam berinteraksi dengan PDAM.</p>',
                'sort_order' => 5,
                'is_active' => true
            ],
            [
                'year' => '2020',
                'title' => 'Penanganan Pandemi COVID-19',
                'description' => 'Implementasi protokol kesehatan dan program bantuan air bersih selama pandemi COVID-19.',
                'detailed_content' => '<p>Pandemi COVID-19 menuntut PDAM Tirta Perwira untuk beradaptasi dengan situasi darurat kesehatan. Perusahaan mengimplementasikan protokol kesehatan ketat, memastikan kontinuitas pelayanan air bersih, dan meluncurkan program bantuan air bersih untuk masyarakat terdampak.</p><p>Program ini mencakup penyediaan air gratis di tempat-tempat umum, fasilitas cuci tangan, dan dukungan bagi rumah tangga yang mengalami kesulitan ekonomi akibat pandemi.</p>',
                'sort_order' => 6,
                'is_active' => true
            ],
            [
                'year' => '2023',
                'title' => 'Smart Water Management',
                'description' => 'Implementasi sistem manajemen air pintar dengan teknologi IoT dan AI untuk optimalisasi distribusi.',
                'detailed_content' => '<p>Pada tahun 2023, PDAM Tirta Perwira melangkah ke era Smart Water Management dengan mengimplementasikan teknologi Internet of Things (IoT) dan Artificial Intelligence (AI). Sistem ini memungkinkan monitoring real-time terhadap kualitas air, tekanan distribusi, dan deteksi dini kebocoran pipa.</p><p>Teknologi smart ini meningkatkan efisiensi distribusi, mengurangi kehilangan air, dan memberikan data akurat untuk pengambilan keputusan strategis dalam pengembangan layanan.</p>',
                'sort_order' => 7,
                'is_active' => true
            ]
        ];

        foreach ($histories as $history) {
            CompanyHistory::create($history);
        }
    }
}
