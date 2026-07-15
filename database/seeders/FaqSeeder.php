<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Cara mengecek jumlah tagihan air bulanan.',
                'answer' => '<p>Pelanggan dapat mengecek estimasi atau jumlah tagihan secara mandiri melalui:</p>
                <ul>
                    <li>Aplikasi mobile resmi PDAM atau portal website pelanggan.</li>
                    <li>Aplikasi e-commerce (Tokopedia, Shopee, dll) dan dompet digital (Dana, GoPay, OVO).</li>
                    <li>Layanan mobile banking atau ATM bank yang bekerja sama.</li>
                    <li>Minimarket terdekat (Indomaret, Alfamart) dengan memberikan Nomor Pelanggan/Nomor Sambungan ke kasir.</li>
                </ul>',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'question' => 'Batas waktu pembayaran tagihan dan ketentuan denda keterlambatan.',
                'answer' => '<p>Tagihan air sudah bisa dibayarkan mulai tanggal 1 setiap bulannya. Batas akhir pembayaran (jatuh tempo) adalah tanggal 20 setiap bulan. Jika pelanggan membayar melewati tanggal 20, maka akan otomatis dikenakan denda administratif yang besarannya disesuaikan dengan golongan tarif pelanggan. Jika tunggakan berlanjut hingga waktu tertentu (biasanya 2-3 bulan), dapat dilakukan penyegelan atau pemutusan sementara.</p>',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'question' => 'Penyebab utama lonjakan jumlah tagihan air.',
                'answer' => '<p>Lonjakan tagihan di luar kebiasaan umumnya disebabkan oleh tiga hal:</p>
                <ul>
                    <li><strong>Kebocoran instalasi dalam:</strong> Terdapat kebocoran pada pipa setelah meteran air (di dalam area rumah).</li>
                    <li><strong>Perubahan pola pemakaian:</strong> Peningkatan penggunaan air yang tidak disadari (misalnya ada renovasi, acara keluarga, kran lupa ditutup, atau tandon bocor).</li>
                    <li><strong>Akumulasi tagihan:</strong> Pada bulan sebelumnya meteran tidak bisa dibaca oleh petugas (misalnya pagar rumah terkunci atau meteran tertutup material), sehingga tagihan ditaksir berdasarkan rata-rata, dan pemakaian riilnya baru terakumulasi saat meteran berhasil dibaca di bulan ini.</li>
                </ul>',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'question' => 'Langkah yang harus dilakukan saat aliran air mengecil atau mati.',
                'answer' => '<ol>
                    <li>Pertama, pastikan stop kran (engkol) di dekat meteran air dalam posisi terbuka penuh.</li>
                    <li>Cek media sosial atau website resmi PDAM untuk melihat apakah ada pengumuman perbaikan pipa atau pemadaman listrik yang memengaruhi pompa distribusi di wilayah Anda.</li>
                    <li>Jika tidak ada informasi gangguan massal, segera buat laporan melalui Call Center, WhatsApp pengaduan, atau aplikasi layanan dengan menyertakan Nomor Pelanggan dan alamat lengkap agar petugas bisa melakukan pengecekan lapangan.</li>
                </ol>',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'question' => 'Penyebab dan solusi penanganan saat air keluar dalam kondisi keruh atau berbau.',
                'answer' => '<p>Kekeruhan biasanya bersifat sementara dan sering terjadi setelah petugas selesai melakukan perbaikan kebocoran pipa utama. Saat aliran air dinyalakan kembali, endapan di dalam pipa bisa terbawa arus.</p>
                <p><strong>Solusi:</strong> Buka kran air yang letaknya paling dekat dengan meteran. Biarkan air mengalir (di-flushing) selama beberapa saat hingga kotorannya terbuang dan air kembali jernih. Jika kondisi keruh/berbau tidak kunjung hilang setelah beberapa jam, segera laporkan ke layanan pengaduan.</p>',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'question' => 'Prosedur pelaporan jika meteran air rusak, buram, atau tidak terbaca.',
                'answer' => '<p>Pelanggan dapat memfoto kondisi meteran air tersebut dan melaporkannya melalui WhatsApp pengaduan, aplikasi layanan, atau datang ke kantor PDAM terdekat dengan menyebutkan Nomor Pelanggan.</p>
                <p>Penggantian meteran air yang buram, berembun, atau rusak karena usia pemakaian/teknis alat tidak dikenakan biaya (gratis).</p>
                <p>Namun, jika kerusakan disebabkan oleh kelalaian pelanggan (misal: pecah terbentur kendaraan atau dirusak sengaja), akan dikenakan biaya penggantian meteran.</p>',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'question' => 'Syarat dokumen untuk mengajukan pemasangan sambungan baru.',
                'answer' => '<p>Calon pelanggan perlu menyiapkan berkas persyaratan dasar, meliputi:</p>
                <ul>
                    <li>Fotokopi KTP yang masih berlaku.</li>
                    <li>Fotokopi Kartu Keluarga (KK).</li>
                    <li>Fotokopi rekening listrik terbaru atau bukti PBB (Pajak Bumi dan Bangunan).</li>
                    <li>Denah atau sketsa lokasi rumah (untuk mempermudah petugas survei).</li>
                    <li>Materai (jika diperlukan untuk formulir perjanjian pelanggan).</li>
                </ul>',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'question' => 'Estimasi biaya dan alur proses pendaftaran hingga pemasangan fisik.',
                'answer' => '<p><strong>Alur Proses:</strong> Pendaftaran (penyerahan berkas) ➔ Petugas melakukan survei lokasi dan pengukuran ➔ PDAM menerbitkan Rencana Anggaran Biaya (RAB) ➔ Calon pelanggan membayar RAB ke loket/bank resmi ➔ Petugas melakukan pemasangan instalasi dan meteran air di lokasi.</p>
                <p><strong>Estimasi Biaya:</strong> Biaya pasang baru bervariasi bergantung pada golongan tarif pelanggan (Sosial, Rumah Tangga, Niaga) serta panjang pipa yang dibutuhkan dari jaringan utama (retikulasi) ke titik meteran rumah. Pembayaran wajib dilakukan di loket resmi, bukan dititipkan ke petugas survei.</p>',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'question' => 'Penjelasan batas tanggung jawab pemeliharaan instalasi pipa.',
                'answer' => '<ul>
                    <li><strong>Tanggung Jawab PDAM:</strong> Mulai dari sumber air, jaringan perpipaan distribusi di jalan, hingga tepat di unit meteran air milik pelanggan. Segala kebocoran di area ini adalah tanggung jawab PDAM.</li>
                    <li><strong>Tanggung Jawab Pelanggan:</strong> Seluruh instalasi perpipaan setelah meteran air (pipa yang masuk ke dalam rumah, kran, tandon, dll). Jika ada kebocoran di area ini, pelanggan bertanggung jawab penuh atas biaya perbaikan dan lonjakan tagihan air yang ditimbulkan.</li>
                </ul>',
                'order' => 9,
                'is_active' => true,
            ],
        ];

        Faq::truncate();
        
        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
