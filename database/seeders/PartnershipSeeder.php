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
                'name' => 'Bank Jateng',
                'slug' => 'bank-jateng',
                'description' => 'Bank Jateng',
                'website_url' => 'https://www.bankjateng.co.id',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Bank Syariah Indonesia',
                'slug' => 'bank-syariah-indonesia',
                'description' => 'Bank Syariah Indonesia',
                'website_url' => 'https://www.bsi.co.id',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'KIPO',
                'slug' => 'kipo',
                'description' => 'Koperasi Indonesia',
                'website_url' => 'https://www.kipo.co.id',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'MKM',
                'slug' => 'mkm',
                'description' => 'MKM',
                'website_url' => 'https://www.mkm.co.id',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Shopee',
                'slug' => 'shopee',
                'description' => 'E-commerce platform',
                'website_url' => 'https://www.shopee.co.id',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Tokopedia',
                'slug' => 'tokopedia',
                'description' => 'E-commerce platform',
                'website_url' => 'https://www.tokopedia.com',
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
                        [
                'name' => 'PT Pos Indonesia',
                'slug' => 'pt-pos-indonesia',
                'description' => 'PT Pos Indonesia',
                'website_url' => 'https://www.posindonesia.co.id',
                'sort_order' => 9,
                'is_active' => true,
            ],
        ];

        foreach ($partnerships as $partnership) {
            Partnership::create($partnership);
        }
    }
}
