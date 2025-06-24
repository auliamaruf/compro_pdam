<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\User;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::first();        $pages = [
            [
                'title' => 'Kebijakan Privasi',
                'slug' => 'kebijakan-privasi',
                'content' => '<h2>Kebijakan Privasi PDAM Tirta Perwira</h2>

<p>PDAM Tirta Perwira berkomitmen untuk melindungi privasi dan keamanan informasi pribadi yang Anda berikan kepada kami. Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda.</p>

<h3>1. Informasi yang Kami Kumpulkan</h3>
<p>Kami mengumpulkan informasi pribadi yang Anda berikan secara sukarela, termasuk:</p>
<ul>
<li>Nama lengkap dan informasi kontak</li>
<li>Alamat tempat tinggal atau usaha</li>
<li>Nomor telepon dan email</li>
<li>Data penggunaan air dan riwayat pembayaran</li>
<li>Informasi teknis sambungan air</li>
</ul>

<h3>2. Penggunaan Informasi</h3>
<p>Informasi yang kami kumpulkan digunakan untuk:</p>
<ul>
<li>Memberikan layanan air bersih dan administrasi pelanggan</li>
<li>Memproses pembayaran dan mengirimkan tagihan</li>
<li>Meningkatkan kualitas layanan kami</li>
<li>Komunikasi terkait layanan dan pemeliharaan</li>
<li>Mematuhi persyaratan hukum dan peraturan</li>
</ul>

<h3>3. Perlindungan Data</h3>
<p>Kami menerapkan langkah-langkah keamanan teknis dan organisasi yang sesuai untuk melindungi informasi pribadi Anda dari akses, penggunaan, atau pengungkapan yang tidak sah.</p>

<h3>4. Berbagi Informasi</h3>
<p>Kami tidak akan menjual, menyewakan, atau membagikan informasi pribadi Anda kepada pihak ketiga tanpa persetujuan Anda, kecuali dalam situasi berikut:</p>
<ul>
<li>Untuk mematuhi kewajiban hukum</li>
<li>Untuk melindungi hak dan keamanan PDAM</li>
<li>Dengan penyedia layanan yang membantu operasional kami</li>
</ul>

<h3>5. Hak Anda</h3>
<p>Anda memiliki hak untuk:</p>
<ul>
<li>Mengakses dan memperbarui informasi pribadi Anda</li>
<li>Meminta penghapusan data dalam kondisi tertentu</li>
<li>Menarik persetujuan penggunaan data</li>
<li>Mengajukan keluhan terkait penggunaan data</li>
</ul>

<h3>6. Kontak</h3>
<p>Jika Anda memiliki pertanyaan tentang kebijakan privasi ini, silakan hubungi kami di:</p>
<p>Email: privacy@tirtaperwira.purbalinggakab.go.id<br>
Telepon: (0281) 891-234</p>

<p><em>Kebijakan ini terakhir diperbarui pada 1 Juli 2025.</em></p>',
                'excerpt' => 'Kebijakan privasi PDAM Tirta Perwira mengenai pengumpulan, penggunaan, dan perlindungan data pribadi pelanggan.',
                'status' => 'published',
                'show_in_menu' => true,
                'published_at' => now(),
                'meta' => [
                    'description' => 'Kebijakan privasi PDAM Tirta Perwira mengenai pengumpulan, penggunaan, dan perlindungan data pribadi pelanggan.',
                    'keywords' => 'kebijakan privasi, perlindungan data, PDAM Tirta Perwira',
                ],
            ],
            [
                'title' => 'Syarat dan Ketentuan Layanan',
                'slug' => 'syarat-ketentuan-layanan',
                'content' => '<h2>Syarat dan Ketentuan Layanan PDAM Tirta Perwira</h2>

<p>Dengan menggunakan layanan PDAM Tirta Perwira, Anda menyetujui syarat dan ketentuan berikut:</p>

<h3>1. Definisi</h3>
<ul>
<li><strong>PDAM:</strong> Perumda Air Minum Tirta Perwira</li>
<li><strong>Pelanggan:</strong> Pihak yang menggunakan layanan air bersih PDAM</li>
<li><strong>Sambungan:</strong> Instalasi pipa dan meter air milik PDAM di lokasi pelanggan</li>
</ul>

<h3>2. Layanan Air Bersih</h3>
<ul>
<li>PDAM berkomitmen menyediakan air bersih sesuai standar kesehatan</li>
<li>Kualitas air dipantau secara berkala sesuai peraturan yang berlaku</li>
<li>Kontinuitas layanan dapat terpengaruh karena pemeliharaan atau kondisi darurat</li>
</ul>

<h3>3. Kewajiban Pelanggan</h3>
<ul>
<li>Membayar tagihan sesuai dengan tarif yang berlaku</li>
<li>Menjaga meter air dan instalasi sambungan</li>
<li>Melaporkan kerusakan atau kebocoran dengan segera</li>
<li>Tidak menggunakan air untuk keperluan di luar yang disebutkan dalam kontrak</li>
<li>Memberikan akses kepada petugas PDAM untuk pemeliharaan</li>
</ul>

<h3>4. Tarif dan Pembayaran</h3>
<ul>
<li>Tarif ditetapkan berdasarkan Peraturan Daerah yang berlaku</li>
<li>Pembayaran harus dilakukan sebelum tanggal jatuh tempo</li>
<li>Keterlambatan pembayaran dikenakan denda sesuai ketentuan</li>
<li>Sambungan dapat ditutup sementara jika terdapat tunggakan</li>
</ul>

<h3>5. Pemutusan Layanan</h3>
<p>PDAM berhak memutus layanan dalam kondisi:</p>
<ul>
<li>Tunggakan pembayaran lebih dari 3 bulan</li>
<li>Pelanggaran terhadap syarat dan ketentuan</li>
<li>Penggunaan illegal atau manipulasi meter</li>
<li>Mengganggu sistem distribusi PDAM</li>
</ul>

<h3>6. Force Majeure</h3>
<p>PDAM tidak bertanggung jawab atas gangguan layanan yang disebabkan oleh:</p>
<ul>
<li>Bencana alam</li>
<li>Kondisi cuaca ekstrem</li>
<li>Gangguan listrik berkepanjangan</li>
<li>Keadaan darurat lainnya di luar kendali PDAM</li>
</ul>

<h3>7. Penyelesaian Sengketa</h3>
<p>Setiap sengketa akan diselesaikan melalui:</p>
<ul>
<li>Musyawarah dan mufakat</li>
<li>Mediasi jika diperlukan</li>
<li>Pengadilan negeri yang berwenang sebagai upaya terakhir</li>
</ul>

<p><em>Syarat dan ketentuan ini berlaku sejak 1 Januari 2025.</em></p>',
                'excerpt' => 'Syarat dan ketentuan layanan PDAM Tirta Perwira yang mengatur hak dan kewajiban pelanggan.',
                'status' => 'published',
                'show_in_menu' => true,
                'published_at' => now(),
                'meta' => [
                    'description' => 'Syarat dan ketentuan layanan PDAM Tirta Perwira yang mengatur hak dan kewajiban pelanggan.',
                    'keywords' => 'syarat ketentuan, layanan PDAM, kewajiban pelanggan',
                ],
            ],
            [
                'title' => 'Prosedur Pengaduan Pelanggan',
                'slug' => 'prosedur-pengaduan-pelanggan',
                'content' => '<h2>Prosedur Pengaduan Pelanggan PDAM Tirta Perwira</h2>

<p>PDAM Tirta Perwira berkomitmen memberikan pelayanan terbaik kepada seluruh pelanggan. Jika Anda memiliki keluhan atau masukan, silakan ikuti prosedur pengaduan berikut:</p>

<h3>1. Jenis Pengaduan</h3>
<ul>
<li>Gangguan kualitas air (keruh, berbau, berasa)</li>
<li>Masalah tekanan air rendah atau tidak ada air</li>
<li>Kerusakan meter air atau sambungan</li>
<li>Kebocoran pipa distribusi</li>
<li>Tagihan yang tidak sesuai</li>
<li>Pelayanan petugas</li>
<li>Keluhan administrasi lainnya</li>
</ul>

<h3>2. Cara Menyampaikan Pengaduan</h3>

<h4>A. Datang Langsung</h4>
<ul>
<li>Kantor Pusat: Jl. Jenderal Ahmad Yani No. 123, Purbalingga</li>
<li>Kantor Cabang Bobotsari: Jl. Raya Bobotsari No. 45</li>
<li>Kantor Cabang Bukateja: Jl. Diponegoro No. 12</li>
<li>Kantor Cabang Kaligondang: Jl. Raya Kaligondang No. 78</li>
</ul>

<h4>B. Melalui Telepon</h4>
<ul>
<li>Customer Service: (0281) 891-234</li>
<li>Emergency 24 Jam: (0281) 891-999</li>
<li>WhatsApp CS: 0812-1234-5678</li>
</ul>

<h4>C. Melalui Online</h4>
<ul>
<li>Website: www.tirtaperwira.purbalinggakab.go.id</li>
<li>Email: pengaduan@tirtaperwira.purbalinggakab.go.id</li>
<li>Aplikasi Mobile PDAM Tirta Perwira</li>
<li>Media sosial resmi PDAM</li>
</ul>

<h3>3. Standar Waktu Penanganan</h3>
<ul>
<li><strong>Emergency (bocor pipa besar):</strong> Maksimal 2 jam</li>
<li><strong>Gangguan kualitas air:</strong> Maksimal 24 jam</li>
<li><strong>Masalah teknis:</strong> 1-3 hari kerja</li>
<li><strong>Keluhan administrasi:</strong> 3-5 hari kerja</li>
<li><strong>Keluhan kompleks:</strong> Maksimal 14 hari kerja</li>
</ul>

<p><strong>Catatan:</strong> Untuk emergency seperti bocor pipa besar atau gangguan kualitas air yang berbahaya, segera hubungi nomor emergency 24 jam di (0281) 891-999.</p>',
                'excerpt' => 'Prosedur lengkap pengaduan pelanggan PDAM Tirta Perwira dengan berbagai cara dan standar waktu penanganan.',
                'status' => 'published',
                'show_in_menu' => true,
                'published_at' => now(),
                'meta' => [
                    'description' => 'Prosedur lengkap pengaduan pelanggan PDAM Tirta Perwira dengan berbagai cara dan standar waktu penanganan.',
                    'keywords' => 'prosedur pengaduan, customer service, keluhan pelanggan, PDAM',
                ],
            ],
            [
                'title' => 'FAQ - Frequently Asked Questions',
                'slug' => 'faq-pertanyaan-umum',
                'content' => '<h2>FAQ - Pertanyaan yang Sering Diajukan</h2>

<h3>💧 Tentang Layanan Air</h3>

<h4>Q: Bagaimana cara mendaftar sambungan air baru?</h4>
<p>A: Untuk mendaftar sambungan baru, silakan datang ke kantor PDAM terdekat dengan membawa persyaratan: KTP, KK, surat keterangan domisili, IMB (jika ada), dan surat permohonan bermaterai. Proses pemasangan memakan waktu 5-7 hari kerja setelah survey lokasi.</p>

<h4>Q: Mengapa air kadang keruh atau berbau?</h4>
<p>A: Kondisi ini bisa terjadi karena pemeliharaan jaringan, cuaca ekstrem, atau gangguan teknis. Jika terjadi, segera lapor ke customer service kami di (0281) 891-234. Tim kami akan segera melakukan pengecekan dan perbaikan.</p>

<h3>💰 Tentang Tarif dan Pembayaran</h3>

<h4>Q: Bagaimana cara menghitung tarif air?</h4>
<p>A: Tarif dihitung berdasarkan golongan pelanggan dan volume pemakaian per bulan. Terdiri dari biaya pemakaian air, biaya beban tetap, biaya administrasi, dan biaya pemeliharaan. Detail perhitungan tercantum di tagihan bulanan.</p>

<h4>Q: Dimana saja bisa bayar tagihan air?</h4>
<p>A: Tagihan bisa dibayar di kantor PDAM, bank-bank yang bekerjasama, ATM dan internet banking, Indomaret dan Alfamart, E-wallet (GoPay, OVO, DANA, ShopeePay), dan Aplikasi PDAM Tirta Perwira.</p>

<p><em>Masih ada pertanyaan? Hubungi customer service kami di (0281) 891-234 atau kunjungi kantor terdekat.</em></p>',
                'excerpt' => 'Pertanyaan yang sering diajukan (FAQ) seputar layanan PDAM Tirta Perwira beserta jawabannya.',
                'status' => 'published',
                'show_in_menu' => true,
                'published_at' => now(),
                'meta' => [
                    'description' => 'Pertanyaan yang sering diajukan (FAQ) seputar layanan PDAM Tirta Perwira beserta jawabannya.',
                    'keywords' => 'FAQ, pertanyaan umum, layanan PDAM, panduan pelanggan',
                ],
            ],
            [
                'title' => 'Panduan Hemat Air',
                'slug' => 'panduan-hemat-air',
                'content' => '<h2>Panduan Hemat Air untuk Rumah Tangga</h2>

<p>Air adalah sumber daya yang berharga. Dengan menghemat air, kita tidak hanya mengurangi tagihan bulanan tetapi juga berkontribusi pada pelestarian lingkungan. Berikut tips praktis untuk menghemat air di rumah:</p>

<h3>🚿 Di Kamar Mandi</h3>
<ul>
<li><strong>Mandi dengan shower:</strong> Gunakan shower daripada gayung untuk menghemat hingga 50% air</li>
<li><strong>Batasi waktu mandi:</strong> Maksimal 5-7 menit per mandi</li>
<li><strong>Matikan air saat menyabun:</strong> Jangan biarkan air mengalir saat menggosok sabun atau shampo</li>
<li><strong>Perbaiki keran bocor:</strong> Keran yang menetes dapat membuang 100+ liter air per hari</li>
</ul>

<h3>🍽️ Di Dapur</h3>
<ul>
<li><strong>Cuci piring secara efisien:</strong> Kumpulkan piring kotor sebelum mencuci</li>
<li><strong>Gunakan baskom:</strong> Isi baskom untuk merendam dan membilas piring</li>
<li><strong>Matikan keran saat menyabun:</strong> Nyalakan hanya saat membilas</li>
<li><strong>Cuci sayuran dalam baskom:</strong> Air bekas cuci sayuran bisa untuk menyiram tanaman</li>
</ul>

<h3>🌱 Di Taman dan Halaman</h3>
<ul>
<li><strong>Siram pagi atau sore:</strong> Hindari penyiraman saat panas terik</li>
<li><strong>Gunakan air bekas:</strong> Manfaatkan air bekas cucian atau masak</li>
<li><strong>Mulsa tanaman:</strong> Gunakan mulsa untuk mengurangi penguapan</li>
<li><strong>Tampung air hujan:</strong> Gunakan bak atau drum untuk menampung air hujan</li>
</ul>

<h3>💰 Manfaat Hemat Air</h3>
<ul>
<li><strong>Penghematan biaya:</strong> Tagihan air bulanan lebih rendah</li>
<li><strong>Pelestarian lingkungan:</strong> Mengurangi tekanan pada sumber air</li>
<li><strong>Keberlanjutan:</strong> Menjaga ketersediaan air untuk generasi mendatang</li>
</ul>

<p><strong>Ingat:</strong> Setiap tetes air yang dihemat hari ini adalah investasi untuk masa depan yang lebih baik. Mari bersama-sama menjaga kelestarian air untuk generasi mendatang!</p>

<p><em>Untuk konsultasi lebih lanjut tentang penghematan air, hubungi PDAM Tirta Perwira di (0281) 891-234.</em></p>',
                'excerpt' => 'Panduan lengkap cara menghemat air di rumah tangga untuk mengurangi tagihan dan melestarikan lingkungan.',
                'status' => 'published',
                'show_in_menu' => true,
                'published_at' => now(),
                'meta' => [
                    'description' => 'Panduan lengkap cara menghemat air di rumah tangga untuk mengurangi tagihan dan melestarikan lingkungan.',
                    'keywords' => 'hemat air, tips penghematan, konservasi air, rumah tangga',
                ],
            ]
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
