<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Pemasangan Sambungan Baru Rumah Tangga',
                'slug' => 'pemasangan-sambungan-baru-rumah-tangga',
                'description' => 'Layanan pemasangan sambungan air bersih baru untuk rumah tangga dengan meter standar ¾ inch',
                'category' => 'new_connection',
                'requirements' => [
                    'Fotokopi KTP Pemohon yang masih berlaku',
                    'Fotokopi KK (Kartu Keluarga)',
                    'Surat Keterangan Domisili dari RT/RW',
                    'Fotokopi IMB atau Surat Keterangan Bangunan',
                    'Surat Permohonan bermaterai',
                    'Pas foto 3x4 sebanyak 2 lembar'
                ],
                'process_time' => '5-7 hari kerja',
                'fee' => 500000,
                'procedure' => 'Mengajukan permohonan di kantor PDAM → Survey lokasi oleh petugas teknik → Pembayaran biaya pemasangan → Instalasi sambungan dan meter → Aktivasi layanan',
                'contact_person' => 'Bagian Pelayanan Pelanggan',
                'contact_phone' => '0281-891234',
                'is_active' => true,
                'is_featured' => true,
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 1,
                'navbar_label' => 'Sambungan Baru',
                'navbar_icon' => 'fas fa-home',
                'is_navbar_featured' => true,
            ],
            [
                'name' => 'Pemasangan Sambungan Baru Komersial',
                'slug' => 'pemasangan-sambungan-baru-komersial',
                'description' => 'Layanan pemasangan sambungan air bersih untuk usaha komersial seperti toko, warung, dan kantor',
                'category' => 'new_connection',
                'requirements' => [
                    'Fotokopi KTP Pemohon/Pemilik Usaha',
                    'Fotokopi SIUP atau NIB',
                    'Fotokopi IMB Bangunan',
                    'Surat Permohonan bermaterai',
                    'Denah lokasi usaha',
                    'Surat Keterangan dari Lurah/Camat'
                ],
                'process_time' => '7-10 hari kerja',
                'fee' => 1200000,
                'procedure' => 'Pengajuan permohonan → Survey teknis dan kelayakan → Evaluasi dokumen → Pembayaran → Pemasangan sambungan',
                'contact_person' => 'Bagian Pengembangan',
                'contact_phone' => '0281-891235',
                'is_active' => true,
                'is_featured' => true,
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 2,
                'navbar_label' => 'Sambungan Komersial',
                'navbar_icon' => 'fas fa-building',
                'is_navbar_featured' => true,
            ],
            [
                'name' => 'Pemasangan Sambungan Baru Industri',
                'slug' => 'pemasangan-sambungan-baru-industri',
                'description' => 'Layanan pemasangan sambungan air bersih untuk kebutuhan industri dengan kapasitas besar',
                'category' => 'new_connection',
                'requirements' => [
                    'Fotokopi Akta Pendirian Perusahaan',
                    'Fotokopi NPWP Perusahaan',
                    'Fotokopi IUI (Izin Usaha Industri)',
                    'Fotokopi IMB Pabrik',
                    'Studi kelayakan penggunaan air',
                    'Gambar teknis instalasi',
                    'AMDAL (jika diperlukan)'
                ],
                'process_time' => '14-21 hari kerja',
                'fee' => 2500000,
                'procedure' => 'Pengajuan proposal → Evaluasi teknis dan lingkungan → Persetujuan manajemen → Kontrak kerjasama → Instalasi sambungan industri',
                'contact_person' => 'Bagian Teknik Industri',
                'contact_phone' => '0281-891236',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Perbaikan dan Penggantian Meter Air',
                'slug' => 'perbaikan-penggantian-meter-air',
                'description' => 'Layanan perbaikan meter air yang rusak atau penggantian meter yang sudah tidak berfungsi dengan baik',
                'category' => 'technical',
                'requirements' => [
                    'KTP Pemilik Sambungan',
                    'Bukti Kepemilikan Sambungan (Surat Perjanjian)',
                    'Laporan Kerusakan tertulis',
                    'Foto kondisi meter (jika memungkinkan)'
                ],
                'process_time' => '1-3 hari kerja',
                'fee' => 150000,
                'procedure' => 'Lapor kerusakan ke customer service → Verifikasi lapangan oleh teknisi → Analisa kerusakan → Perbaikan atau penggantian → Pengujian dan kalibrasi',
                'contact_person' => 'Bagian Teknik',
                'contact_phone' => '0281-891237',
                'is_active' => true,
                'is_featured' => false,
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 3,
                'navbar_label' => 'Perbaikan Meter',
                'navbar_icon' => 'fas fa-tools',
                'is_navbar_featured' => false,
            ],
            [
                'name' => 'Perbaikan Pipa dan Sambungan Bocor',
                'slug' => 'perbaikan-pipa-sambungan-bocor',
                'description' => 'Layanan perbaikan pipa distribusi dan sambungan pelanggan yang mengalami kebocoran',
                'category' => 'technical',
                'requirements' => [
                    'Laporan kebocoran (lokasi dan kondisi)',
                    'Data pelanggan (jika di area sambungan)',
                    'Akses ke lokasi kebocoran'
                ],
                'process_time' => '6-12 jam',
                'fee' => 0,
                'procedure' => 'Lapor kebocoran → Respon cepat tim teknis → Isolasi area → Perbaikan pipa → Pengujian tekanan → Normalisasi distribusi',
                'contact_person' => 'Emergency Service',
                'contact_phone' => '0281-891999',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'name' => 'Pengaduan Kualitas Air',
                'slug' => 'pengaduan-kualitas-air',
                'description' => 'Layanan pengaduan terkait kualitas air yang tidak sesuai standar seperti keruh, berbau, atau berasa',
                'category' => 'customer_service',
                'requirements' => [
                    'Data lengkap pelanggan',
                    'Deskripsi masalah kualitas air',
                    'Foto kondisi air (jika memungkinkan)',
                    'Waktu kejadian masalah'
                ],
                'process_time' => '24 jam',
                'fee' => 0,
                'procedure' => 'Lapor keluhan → Investigasi lapangan → Pengambilan sampel air → Analisa laboratorium → Tindak lanjut perbaikan → Laporan hasil',
                'contact_person' => 'Customer Service',
                'contact_phone' => '0281-891234',
                'is_active' => true,
                'is_featured' => true,
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 5,
                'navbar_label' => 'Pengaduan',
                'navbar_icon' => 'fas fa-comments',
                'is_navbar_featured' => false,
            ],
            [
                'name' => 'Layanan Cek Tagihan dan Pembayaran',
                'slug' => 'layanan-cek-tagihan-pembayaran',
                'description' => 'Layanan informasi tagihan, riwayat pembayaran, dan berbagai metode pembayaran yang tersedia',
                'category' => 'customer_service',
                'requirements' => [
                    'Nomor pelanggan atau alamat',
                    'KTP pemilik sambungan'
                ],
                'process_time' => 'Instant',
                'fee' => 0,
                'procedure' => 'Datang ke kantor PDAM → Sebutkan nomor pelanggan → Petugas akan menampilkan informasi tagihan → Pembayaran dapat dilakukan langsung',
                'contact_person' => 'Kasir dan Customer Service',
                'contact_phone' => '0281-891234',
                'is_active' => true,
                'is_featured' => false,
                // Navbar configuration
                'show_in_navbar' => true,
                'navbar_order' => 4,
                'navbar_label' => 'Cek Tagihan',
                'navbar_icon' => 'fas fa-credit-card',
                'is_navbar_featured' => true,
            ],
            [
                'name' => 'Balik Nama Sambungan',
                'slug' => 'balik-nama-sambungan',
                'description' => 'Layanan pengalihan kepemilikan sambungan air dari nama lama ke nama baru',
                'category' => 'billing',
                'requirements' => [
                    'KTP pemilik lama dan pemilik baru',
                    'Surat pernyataan peralihan hak',
                    'Bukti kepemilikan sambungan lama',
                    'Surat kuasa (jika diwakilkan)',
                    'Materai secukupnya'
                ],
                'process_time' => '3-5 hari kerja',
                'fee' => 100000,
                'procedure' => 'Pengajuan permohonan → Verifikasi dokumen → Pembayaran biaya administrasi → Perubahan data sistem → Penerbitan dokumen baru',
                'contact_person' => 'Bagian Administrasi',
                'contact_phone' => '0281-891238',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Penutupan Sementara Sambungan',
                'slug' => 'penutupan-sementara-sambungan',
                'description' => 'Layanan penutupan sementara sambungan untuk keperluan renovasi, perjalanan panjang, atau keperluan lain',
                'category' => 'billing',
                'requirements' => [
                    'Surat permohonan penutupan',
                    'KTP pemilik sambungan',
                    'Pelunasan tagihan yang ada',
                    'Alasan penutupan sementara'
                ],
                'process_time' => '1-2 hari kerja',
                'fee' => 50000,
                'procedure' => 'Pengajuan permohonan → Pelunasan tagihan → Pembayaran biaya administrasi → Penutupan sambungan → Pencatatan sistem',
                'contact_person' => 'Bagian Pelayanan',
                'contact_phone' => '0281-891234',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Aktivasi Kembali Sambungan',
                'slug' => 'aktivasi-kembali-sambungan',
                'description' => 'Layanan mengaktifkan kembali sambungan yang sebelumnya ditutup sementara atau karena tunggakan',
                'category' => 'billing',
                'requirements' => [
                    'Surat permohonan aktivasi',
                    'KTP pemilik sambungan',
                    'Pelunasan tunggakan (jika ada)',
                    'Bukti pembayaran biaya aktivasi'
                ],
                'process_time' => '1-2 hari kerja',
                'fee' => 75000,
                'procedure' => 'Pengajuan permohonan → Pelunasan tunggakan → Pembayaran biaya aktivasi → Pemeriksaan teknis → Aktivasi sambungan',
                'contact_person' => 'Bagian Pelayanan',
                'contact_phone' => '0281-891234',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Konsultasi Teknis Instalasi Air',
                'slug' => 'konsultasi-teknis-instalasi-air',
                'description' => 'Layanan konsultasi teknis untuk perencanaan instalasi air, sistem perpipaan, dan optimalisasi penggunaan air',
                'category' => 'technical',
                'requirements' => [
                    'Denah lokasi atau bangunan',
                    'Rencana penggunaan air',
                    'Data teknis yang tersedia'
                ],
                'process_time' => '2-3 hari kerja',
                'fee' => 200000,
                'procedure' => 'Konsultasi awal → Survey lokasi → Analisa teknis → Penyusunan rekomendasi → Presentasi hasil konsultasi',
                'contact_person' => 'Bagian Teknik',
                'contact_phone' => '0281-891237',
                'is_active' => true,
                'is_featured' => false,
            ],
            [
                'name' => 'Sertifikat Kualitas Air',
                'slug' => 'sertifikat-kualitas-air',
                'description' => 'Layanan penerbitan sertifikat hasil uji kualitas air untuk keperluan tertentu seperti industri makanan atau perizinan',
                'category' => 'other',
                'requirements' => [
                    'Surat permohonan pengujian',
                    'Sampel air yang akan diuji',
                    'Keperluan pengujian',
                    'Pembayaran biaya laboratorium'
                ],
                'process_time' => '5-7 hari kerja',
                'fee' => 300000,
                'procedure' => 'Pengajuan permohonan → Pengambilan sampel → Pengujian laboratorium → Analisa hasil → Penerbitan sertifikat',
                'contact_person' => 'Laboratorium Kualitas',
                'contact_phone' => '0281-891239',
                'is_active' => true,
                'is_featured' => false,
            ]
        ];

        foreach ($services as $service) {
            \App\Models\Service::create($service);
        }
    }
}
