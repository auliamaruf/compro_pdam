<?php

namespace Database\Seeders;

use App\Models\WaterSource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaterSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $waterSources = [
            [
                'name' => 'Mata Air Gunung Merapi',
                'address' => 'Desa Wukirsari, Kecamatan Cangkringan, Sleman, DIY',
                'production_capacity' => 150.50,
                'status' => 'active',
                'ownership' => 'milik_sendiri',
                'distribution_area' => 'Kecamatan Cangkringan, Pakem, dan sebagian Ngemplak',
                'description' => 'Sumber mata air alami dari lereng Gunung Merapi dengan kualitas air yang sangat baik dan debit yang stabil sepanjang tahun.',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Mata Air Tlogo Putri',
                'address' => 'Desa Kaliurang, Kecamatan Pakem, Sleman, DIY',
                'production_capacity' => 89.75,
                'status' => 'active',
                'ownership' => 'milik_sendiri',
                'distribution_area' => 'Kecamatan Pakem, Tempel, dan sebagian Turi',
                'description' => 'Mata air jernih dengan suhu yang sejuk, terletak di kawasan wisata Kaliurang dengan akses yang mudah untuk perawatan.',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Mata Air Boyong',
                'address' => 'Desa Hargobinangun, Kecamatan Pakem, Sleman, DIY',
                'production_capacity' => 75.25,
                'status' => 'active',
                'ownership' => 'kerjasama',
                'distribution_area' => 'Kecamatan Pakem bagian selatan dan Mlati bagian utara',
                'description' => 'Sumber mata air hasil kerjasama dengan pemerintah desa setempat, memiliki kualitas air yang baik untuk konsumsi.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Mata Air Krasak',
                'address' => 'Desa Purwobinangun, Kecamatan Pakem, Sleman, DIY',
                'production_capacity' => 45.80,
                'status' => 'maintenance',
                'ownership' => 'milik_sendiri',
                'distribution_area' => 'Kecamatan Pakem bagian tengah',
                'description' => 'Sumber mata air sedang dalam tahap maintenance untuk meningkatkan kapasitas produksi dan kualitas distribusi.',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Mata Air Turgo',
                'address' => 'Desa Purwobinangun, Kecamatan Pakem, Sleman, DIY',
                'production_capacity' => 62.15,
                'status' => 'active',
                'ownership' => 'sewa',
                'distribution_area' => 'Kecamatan Pakem dan Cangkringan bagian barat',
                'description' => 'Mata air dengan kontrak sewa jangka panjang, memberikan pasokan air yang stabil untuk wilayah distribusi yang strategis.',
                'is_active' => true,
                'sort_order' => 5,
            ],
        ];

        foreach ($waterSources as $source) {
            WaterSource::create($source);
        }
    }
}
