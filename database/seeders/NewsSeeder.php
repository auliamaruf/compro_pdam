<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\User;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::first();

        $newsData = [
            [
                'title' => 'Peningkatan Kualitas Air di Zona Purbalingga Utara',
                'slug' => 'peningkatan-kualitas-air-zona-purbalingga-utara',
                'content' => '<p>PDAM Tirta Perwira mengumumkan telah berhasil meningkatkan kualitas air di zona Purbalingga Utara melalui program modernisasi sistem pengolahan air. Program ini melibatkan instalasi teknologi filtration terbaru yang mampu menghasilkan air bersih dengan standar internasional.</p>

<p>Direktur PDAM Tirta Perwira menyampaikan bahwa investasi sebesar Rp 5 miliar ini merupakan komitmen perusahaan untuk memberikan pelayanan terbaik kepada masyarakat. "Kami terus berupaya meningkatkan kualitas air yang didistribusikan kepada pelanggan kami," ujar Direktur.</p>

<p>Program ini diharapkan dapat melayani tambahan 5.000 rumah tangga di wilayah Purbalingga Utara dengan kualitas air yang lebih baik dan tekanan yang lebih stabil.</p>',
                'excerpt' => 'PDAM Tirta Perwira berhasil meningkatkan kualitas air di zona Purbalingga Utara melalui modernisasi sistem pengolahan dengan investasi Rp 5 miliar.',
                'type' => 'news',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(2),
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Pembukaan Kantor Layanan Pelanggan Baru di Kecamatan Bobotsari',
                'slug' => 'pembukaan-kantor-layanan-pelanggan-baru-kecamatan-bobotsari',
                'content' => '<p>Dalam rangka meningkatkan pelayanan kepada masyarakat, PDAM Tirta Perwira dengan bangga mengumumkan pembukaan kantor layanan pelanggan baru di Kecamatan Bobotsari. Kantor ini berlokasi strategis di Jl. Raya Bobotsari No. 45 dan telah resmi beroperasi mulai tanggal 15 Juni 2025.</p>

<p>Kantor layanan baru ini menyediakan berbagai layanan seperti:</p>
<ul>
<li>Pendaftaran sambungan baru</li>
<li>Pembayaran tagihan air</li>
<li>Pengaduan dan komplain</li>
<li>Informasi tarif dan layanan</li>
<li>Konsultasi teknis</li>
</ul>

<p>Dengan hadirnya kantor layanan ini, masyarakat Kecamatan Bobotsari tidak perlu lagi datang ke kantor pusat untuk mendapatkan pelayanan PDAM. Kantor buka setiap hari Senin-Jumat pukul 07.30-15.30 WIB dan Sabtu pukul 07.30-12.00 WIB.</p>',
                'excerpt' => 'PDAM Tirta Perwira membuka kantor layanan pelanggan baru di Kecamatan Bobotsari untuk meningkatkan aksesibilitas pelayanan masyarakat.',
                'type' => 'announcement',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(5),
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Program CSR: Bantuan Air Bersih untuk Desa Terpencil',
                'slug' => 'program-csr-bantuan-air-bersih-desa-terpencil',
                'content' => '<p>PDAM Tirta Perwira melaksanakan program Corporate Social Responsibility (CSR) dengan memberikan bantuan akses air bersih kepada 3 desa terpencil di Kabupaten Purbalingga yang selama ini kesulitan mendapatkan air bersih.</p>

<p>Program yang berlangsung dari bulan Mei hingga Juli 2025 ini meliputi:</p>
<ul>
<li>Pembangunan sumur bor di Desa Kalimanah</li>
<li>Instalasi pompa air tenaga surya di Desa Karangreja</li>
<li>Penyediaan tangki air komunal di Desa Kemangkon</li>
</ul>

<p>Kepala Desa Kalimanah mengucapkan terima kasih atas kepedulian PDAM Tirta Perwira. "Ini sangat membantu masyarakat kami yang selama ini harus mengambil air dari sumber yang jauh," ungkapnya.</p>

<p>Total anggaran program CSR ini mencapai Rp 800 juta dan diharapkan dapat bermanfaat bagi sekitar 1.200 kepala keluarga di ketiga desa tersebut.</p>',
                'excerpt' => 'PDAM Tirta Perwira melaksanakan program CSR bantuan air bersih untuk 3 desa terpencil dengan anggaran Rp 800 juta.',
                'type' => 'csr',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subWeek(),
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Jadwal Pemeliharaan Rutin Jaringan Distribusi Juli 2025',
                'slug' => 'jadwal-pemeliharaan-rutin-jaringan-distribusi-juli-2025',
                'content' => '<p>PDAM Tirta Perwira menginformasikan kepada seluruh pelanggan mengenai jadwal pemeliharaan rutin jaringan distribusi yang akan dilaksanakan selama bulan Juli 2025. Kegiatan ini bertujuan untuk menjaga kualitas dan kontinuitas pelayanan air bersih.</p>

<p><strong>Jadwal Pemeliharaan:</strong></p>
<ul>
<li><strong>5-6 Juli 2025:</strong> Zona Purbalingga Kota (pukul 08.00-16.00)</li>
<li><strong>12-13 Juli 2025:</strong> Zona Bobotsari dan sekitarnya (pukul 08.00-16.00)</li>
<li><strong>19-20 Juli 2025:</strong> Zona Kemangkon dan Kaligondang (pukul 08.00-16.00)</li>
<li><strong>26-27 Juli 2025:</strong> Zona Karangreja dan Bukateja (pukul 08.00-16.00)</li>
</ul>

<p>Selama pemeliharaan, pelanggan di zona terkait akan mengalami gangguan suplai air. Kami mohon maaf atas ketidaknyamanan ini dan mengharapkan pengertian dari seluruh pelanggan.</p>

<p>Untuk informasi lebih lanjut, silakan hubungi call center kami di (0281) 895-123.</p>',
                'excerpt' => 'Informasi jadwal pemeliharaan rutin jaringan distribusi PDAM Tirta Perwira selama bulan Juli 2025 di berbagai zona pelayanan.',
                'type' => 'announcement',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(3),
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Kerjasama dengan Universitas Jenderal Soedirman untuk Penelitian Kualitas Air',
                'slug' => 'kerjasama-universitas-jenderal-soedirman-penelitian-kualitas-air',
                'content' => '<p>PDAM Tirta Perwira menandatangani Memorandum of Understanding (MoU) dengan Universitas Jenderal Soedirman (Unsoed) Purwokerto untuk kerjasama dalam bidang penelitian dan pengembangan kualitas air. Penandatanganan dilakukan di kantor pusat PDAM pada tanggal 18 Juni 2025.</p>

<p>Kerjasama ini meliputi beberapa aspek:</p>
<ul>
<li>Penelitian kualitas air minum dan distribusi</li>
<li>Pengembangan teknologi pengolahan air</li>
<li>Program magang untuk mahasiswa</li>
<li>Pelatihan teknis untuk karyawan PDAM</li>
<li>Seminar dan workshop bersama</li>
</ul>

<p>Rektor Unsoed menyampaikan bahwa kerjasama ini akan memberikan manfaat bagi kedua belah pihak, khususnya dalam pengembangan ilmu pengetahuan dan teknologi di bidang sumber daya air.</p>

<p>Program kerjasama ini akan berlangsung selama 3 tahun dan dapat diperpanjang sesuai evaluasi yang dilakukan bersama.</p>',
                'excerpt' => 'PDAM Tirta Perwira menjalin kerjasama dengan Unsoed Purwokerto untuk penelitian dan pengembangan kualitas air selama 3 tahun.',
                'type' => 'news',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(7),
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Peningkatan Tarif Air Tahun 2025: Penjelasan dan Alasan',
                'slug' => 'peningkatan-tarif-air-tahun-2025-penjelasan-alasan',
                'content' => '<p>PDAM Tirta Perwira mengumumkan adanya penyesuaian tarif air yang akan berlaku efektif mulai 1 Agustus 2025. Keputusan ini diambil setelah melalui kajian mendalam dan persetujuan dari Pemerintah Daerah Kabupaten Purbalingga.</p>

<p><strong>Alasan Penyesuaian Tarif:</strong></p>
<ul>
<li>Kenaikan biaya operasional dan pemeliharaan</li>
<li>Investasi pengembangan infrastruktur</li>
<li>Peningkatan kualitas pelayanan</li>
<li>Inflasi dan penyesuaian upah minimum</li>
</ul>

<p><strong>Besaran Kenaikan:</strong></p>
<ul>
<li>Rumah tangga golongan I (0-10 m³): Rp 3.500 → Rp 3.800</li>
<li>Rumah tangga golongan II (11-20 m³): Rp 4.000 → Rp 4.300</li>
<li>Rumah tangga golongan III (>20 m³): Rp 5.000 → Rp 5.400</li>
<li>Komersial: Rp 7.500 → Rp 8.100</li>
<li>Industri: Rp 8.500 → Rp 9.200</li>
</ul>

<p>Kami berkomitmen untuk terus memberikan pelayanan terbaik dengan tarif yang tetap terjangkau bagi masyarakat.</p>',
                'excerpt' => 'PDAM Tirta Perwira mengumumkan penyesuaian tarif air mulai 1 Agustus 2025 dengan kenaikan rata-rata 8% untuk semua golongan.',
                'type' => 'announcement',
                'status' => 'published',
                'is_featured' => true,
                'published_at' => now()->subDays(1),
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Workshop Konservasi Air untuk Pelajar SMA se-Kabupaten Purbalingga',
                'slug' => 'workshop-konservasi-air-pelajar-sma-kabupaten-purbalingga',
                'content' => '<p>PDAM Tirta Perwira mengadakan workshop konservasi air yang diikuti oleh 150 pelajar SMA se-Kabupaten Purbalingga. Kegiatan ini berlangsung di Aula PDAM Tirta Perwira pada tanggal 20 Juni 2025 dengan tema "Generasi Muda Peduli Konservasi Air".</p>

<p>Materi workshop meliputi:</p>
<ul>
<li>Pentingnya konservasi air untuk masa depan</li>
<li>Cara menghemat air di rumah tangga</li>
<li>Teknologi pengolahan air sederhana</li>
<li>Dampak perubahan iklim terhadap sumber air</li>
<li>Peran generasi muda dalam pelestarian air</li>
</ul>

<p>Narasumber workshop adalah ahli hidrologi dari Institut Teknologi Bandung dan praktisi konservasi air dari Kementerian Lingkungan Hidup. Para peserta antusias mengikuti sesi tanya jawab dan praktik langsung.</p>

<p>Sebagai tindak lanjut, PDAM akan mengadakan kompetisi video edukasi konservasi air untuk pelajar dengan hadiah total Rp 15 juta.</p>',
                'excerpt' => 'PDAM Tirta Perwira mengadakan workshop konservasi air untuk 150 pelajar SMA dengan tema "Generasi Muda Peduli Konservasi Air".',
                'type' => 'news',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(4),
                'author_id' => $admin->id,
            ],
            [
                'title' => 'Sistem Pembayaran Digital PDAM: Kemudahan Bayar Tagihan Air',
                'slug' => 'sistem-pembayaran-digital-pdam-kemudahan-bayar-tagihan-air',
                'content' => '<p>PDAM Tirta Perwira dengan bangga memperkenalkan sistem pembayaran digital yang memudahkan pelanggan dalam membayar tagihan air. Sistem ini dapat diakses melalui aplikasi mobile, website, dan berbagai platform pembayaran digital terpercaya.</p>

<p><strong>Platform Pembayaran yang Tersedia:</strong></p>
<ul>
<li>Aplikasi PDAM Tirta Perwira (Android & iOS)</li>
<li>Website resmi www.tirtaperwira.co.id</li>
<li>Internet banking semua bank</li>
<li>E-wallet: GoPay, OVO, DANA, ShopeePay</li>
<li>Minimarket: Indomaret, Alfamart</li>
<li>ATM bank-bank besar</li>
</ul>

<p><strong>Keuntungan Pembayaran Digital:</strong></p>
<ul>
<li>Bayar kapan saja 24/7</li>
<li>Tidak perlu antre di kantor</li>
<li>Konfirmasi pembayaran real-time</li>
<li>Riwayat pembayaran tersimpan</li>
<li>Notifikasi tagihan dan pembayaran</li>
</ul>

<p>Untuk informasi lebih lanjut dan tutorial penggunaan, silakan kunjungi website kami atau download aplikasi PDAM Tirta Perwira di Google Play Store dan App Store.</p>',
                'excerpt' => 'PDAM Tirta Perwira memperkenalkan sistem pembayaran digital melalui aplikasi mobile, website, dan platform pembayaran digital lainnya.',
                'type' => 'announcement',
                'status' => 'published',
                'is_featured' => false,
                'published_at' => now()->subDays(6),
                'author_id' => $admin->id,
            ],
        ];

        foreach ($newsData as $data) {
            News::create($data);
        }
    }
}
