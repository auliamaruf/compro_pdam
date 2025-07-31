<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Partnership;

class PartnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partnerships = [
            [
                'name' => 'Kementerian PUPR',
                'slug' => 'kementerian-pupr',
                'description' => 'Kementerian Pekerjaan Umum dan Perumahan Rakyat',
                'website_url' => 'https://www.pu.go.id',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Bank Indonesia',
                'slug' => 'bank-indonesia',
                'description' => 'Bank sentral Republik Indonesia',
                'website_url' => 'https://www.bi.go.id',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'PLN Indonesia',
                'slug' => 'pln-indonesia',
                'description' => 'Perusahaan Listrik Negara',
                'website_url' => 'https://www.pln.co.id',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Telkom Indonesia',
                'slug' => 'telkom-indonesia',
                'description' => 'Perusahaan Telekomunikasi Indonesia',
                'website_url' => 'https://www.telkom.co.id',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Pertamina',
                'slug' => 'pertamina',
                'description' => 'Perusahaan Minyak dan Gas Bumi Negara',
                'website_url' => 'https://www.pertamina.com',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'BPJS Kesehatan',
                'slug' => 'bpjs-kesehatan',
                'description' => 'Badan Penyelenggara Jaminan Sosial Kesehatan',
                'website_url' => 'https://www.bpjs-kesehatan.go.id',
                'sort_order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'BNI',
                'slug' => 'bni',
                'description' => 'Bank Negara Indonesia',
                'website_url' => 'https://www.bni.co.id',
                'sort_order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Mandiri',
                'slug' => 'mandiri',
                'description' => 'Bank Mandiri',
                'website_url' => 'https://www.bankmandiri.co.id',
                'sort_order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($partnerships as $partnership) {
            Partnership::create($partnership);
        }
    }
}
