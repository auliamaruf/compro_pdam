<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FixedCost;

class UpdatedFixedCostSeeder extends Seeder
{
    /**
     * Run the database seeds based on PDAM Purbalingga official subscription tariff table.
     */
    public function run(): void
    {
        // Clear existing data
        FixedCost::truncate();
        
        $legalBasisFixedCost = "1. SK Direktur PDAM Kabupaten Purbalingga no.695.1/45.289/PDAM/XI/2010 tanggal 30 Nopember 2010\n2. SK Direktur PDAM Kabupaten Purbalingga No.695.5/036.360/2016 Tanggal 29 Nopember 2016";
        
        $fixedCosts = [
            // SOSIAL
            [
                'category_name' => 'Sosial Umum (HU)',
                'description' => 'Tarif abonemen untuk pelanggan sosial umum (hunian umum)',
                'legal_basis' => $legalBasisFixedCost,
                'monthly_cost' => 11000,
                'installation_cost' => 500000,
                'security_deposit' => 100000,
                'minimum_usage' => 0,
                'meter_size' => '1/2 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Berdasarkan SK Direktur PDAM Kabupaten Purbalingga'
            ],
            [
                'category_name' => 'Sosial Khusus',
                'description' => 'Tarif abonemen untuk pelanggan sosial khusus',
                'legal_basis' => $legalBasisFixedCost,
                'monthly_cost' => 12000,
                'installation_cost' => 550000,
                'security_deposit' => 120000,
                'minimum_usage' => 0,
                'meter_size' => '1/2 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Berdasarkan SK Direktur PDAM Kabupaten Purbalingga'
            ],

            // NON NIAGA
            [
                'category_name' => 'Rumah Tangga Khusus',
                'description' => 'Tarif abonemen untuk rumah tangga khusus',
                'monthly_cost' => 12000,
                'installation_cost' => 600000,
                'security_deposit' => 150000,
                'minimum_usage' => 0,
                'meter_size' => '1/2 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Berdasarkan SK Direktur PDAM Kabupaten Purbalingga'
            ],
            [
                'category_name' => 'Rumah Tangga A',
                'description' => 'Tarif abonemen untuk rumah tangga kategori A',
                'monthly_cost' => 12500,
                'installation_cost' => 650000,
                'security_deposit' => 160000,
                'minimum_usage' => 0,
                'meter_size' => '1/2 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Berdasarkan SK Direktur PDAM Kabupaten Purbalingga'
            ],
            [
                'category_name' => 'Rumah Tangga B',
                'description' => 'Tarif abonemen untuk rumah tangga kategori B',
                'monthly_cost' => 13000,
                'installation_cost' => 700000,
                'security_deposit' => 170000,
                'minimum_usage' => 0,
                'meter_size' => '1/2 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Berdasarkan SK Direktur PDAM Kabupaten Purbalingga'
            ],
            [
                'category_name' => 'Rumah Tangga C',
                'description' => 'Tarif abonemen untuk rumah tangga kategori C',
                'monthly_cost' => 16000,
                'installation_cost' => 750000,
                'security_deposit' => 200000,
                'minimum_usage' => 0,
                'meter_size' => '1/2 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Berdasarkan SK Direktur PDAM Kabupaten Purbalingga'
            ],
            [
                'category_name' => 'Instansi Pemerintah',
                'description' => 'Tarif abonemen untuk instansi pemerintah',
                'monthly_cost' => 21000,
                'installation_cost' => 800000,
                'security_deposit' => 250000,
                'minimum_usage' => 0,
                'meter_size' => '3/4 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Berdasarkan SK Direktur PDAM Kabupaten Purbalingga'
            ],
            [
                'category_name' => 'TNI/POLRI',
                'description' => 'Tarif abonemen untuk TNI/POLRI',
                'monthly_cost' => 41000,
                'installation_cost' => 1000000,
                'security_deposit' => 300000,
                'minimum_usage' => 0,
                'meter_size' => '3/4 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Berdasarkan SK Direktur PDAM Kabupaten Purbalingga'
            ],

            // NIAGA
            [
                'category_name' => 'Niaga Kecil',
                'description' => 'Tarif abonemen untuk niaga kecil',
                'monthly_cost' => 23000,
                'installation_cost' => 1200000,
                'security_deposit' => 400000,
                'minimum_usage' => 0,
                'meter_size' => '3/4 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Berdasarkan SK Direktur PDAM Kabupaten Purbalingga'
            ],
            [
                'category_name' => 'Niaga Besar',
                'description' => 'Tarif abonemen untuk niaga besar',
                'monthly_cost' => 26000,
                'installation_cost' => 1500000,
                'security_deposit' => 500000,
                'minimum_usage' => 0,
                'meter_size' => '1 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Berdasarkan SK Direktur PDAM Kabupaten Purbalingga'
            ],

            // INDUSTRI
            [
                'category_name' => 'Industri Kecil',
                'description' => 'Tarif abonemen untuk industri kecil',
                'monthly_cost' => 28000,
                'installation_cost' => 1800000,
                'security_deposit' => 600000,
                'minimum_usage' => 0,
                'meter_size' => '1 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Berdasarkan SK Direktur PDAM Kabupaten Purbalingga'
            ],
            [
                'category_name' => 'Industri Besar',
                'description' => 'Tarif abonemen untuk industri besar',
                'monthly_cost' => 34000,
                'installation_cost' => 2500000,
                'security_deposit' => 800000,
                'minimum_usage' => 0,
                'meter_size' => '1.5 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Berdasarkan SK Direktur PDAM Kabupaten Purbalingga'
            ],

            // BIAYA TAMBAHAN DAN LAYANAN LAINNYA
            [
                'category_name' => 'Biaya Pemasangan Baru',
                'description' => 'Biaya administrasi pemasangan sambungan baru',
                'monthly_cost' => 0,
                'installation_cost' => 150000,
                'security_deposit' => 0,
                'minimum_usage' => 0,
                'meter_size' => 'Sesuai Kebutuhan',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Biaya administrasi untuk proses pemasangan baru'
            ],
            [
                'category_name' => 'Biaya Pembukaan Kembali',
                'description' => 'Biaya untuk membuka kembali sambungan yang ditutup',
                'monthly_cost' => 0,
                'installation_cost' => 75000,
                'security_deposit' => 0,
                'minimum_usage' => 0,
                'meter_size' => 'Existing',
                'connection_type' => 'replacement',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Biaya untuk membuka kembali sambungan yang telah ditutup'
            ],
            [
                'category_name' => 'Biaya Ganti Nama',
                'description' => 'Biaya administrasi perubahan nama pelanggan',
                'monthly_cost' => 0,
                'installation_cost' => 50000,
                'security_deposit' => 0,
                'minimum_usage' => 0,
                'meter_size' => 'Existing',
                'connection_type' => 'replacement',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Biaya administrasi untuk perubahan nama pelanggan'
            ],
            [
                'category_name' => 'Biaya Penggantian Meter Rusak',
                'description' => 'Biaya penggantian meter air yang rusak atau hilang',
                'monthly_cost' => 0,
                'installation_cost' => 350000,
                'security_deposit' => 0,
                'minimum_usage' => 0,
                'meter_size' => 'Sesuai Kebutuhan',
                'connection_type' => 'replacement',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Termasuk biaya meter baru dan instalasi'
            ],
            [
                'category_name' => 'Biaya Upgrade Meter',
                'description' => 'Biaya untuk upgrade ukuran meter air',
                'monthly_cost' => 0,
                'installation_cost' => 200000,
                'security_deposit' => 100000,
                'minimum_usage' => 0,
                'meter_size' => 'Upgrade Size',
                'connection_type' => 'upgrade',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Biaya untuk mengganti meter dengan ukuran yang lebih besar'
            ],
            [
                'category_name' => 'Biaya Pindah Lokasi Meter',
                'description' => 'Biaya untuk memindahkan lokasi meter air',
                'monthly_cost' => 0,
                'installation_cost' => 250000,
                'security_deposit' => 0,
                'minimum_usage' => 0,
                'meter_size' => 'Existing',
                'connection_type' => 'replacement',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Termasuk biaya pembongkaran dan pemasangan ulang'
            ],
            [
                'category_name' => 'Biaya Surat Keterangan',
                'description' => 'Biaya penerbitan surat keterangan dari PDAM',
                'monthly_cost' => 0,
                'installation_cost' => 25000,
                'security_deposit' => 0,
                'minimum_usage' => 0,
                'meter_size' => '-',
                'connection_type' => 'replacement',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Untuk berbagai keperluan administrasi pelanggan'
            ],
            [
                'category_name' => 'Denda Keterlambatan',
                'description' => 'Denda untuk keterlambatan pembayaran rekening',
                'monthly_cost' => 0,
                'installation_cost' => 10000,
                'security_deposit' => 0,
                'minimum_usage' => 0,
                'meter_size' => '-',
                'connection_type' => 'replacement',
                'is_active' => true,
                'effective_date' => '2025-01-01',
                'notes' => 'Denda per bulan keterlambatan pembayaran'
            ]
        ];

        foreach ($fixedCosts as $fixedCost) {
            // Tambahkan legal_basis jika belum ada
            if (!isset($fixedCost['legal_basis'])) {
                $fixedCost['legal_basis'] = $legalBasisFixedCost;
            }
            FixedCost::create($fixedCost);
        }
    }
}
