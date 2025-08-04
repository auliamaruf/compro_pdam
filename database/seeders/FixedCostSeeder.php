<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FixedCost;

class FixedCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fixedCosts = [
            [
                'category_name' => 'Rumah Tangga',
                'description' => 'Pelanggan rumah tangga dengan meter 1/2 inch',
                'monthly_cost' => 15000,
                'installation_cost' => 500000,
                'security_deposit' => 100000,
                'minimum_usage' => 10,
                'meter_size' => '1/2 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => now(),
                'notes' => 'Biaya untuk sambungan baru rumah tangga'
            ],
            [
                'category_name' => 'Rumah Tangga',
                'description' => 'Pelanggan rumah tangga dengan meter 3/4 inch',
                'monthly_cost' => 20000,
                'installation_cost' => 650000,
                'security_deposit' => 150000,
                'minimum_usage' => 15,
                'meter_size' => '3/4 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => now(),
                'notes' => 'Biaya untuk sambungan baru rumah tangga meter besar'
            ],
            [
                'category_name' => 'Komersial',
                'description' => 'Pelanggan komersial dan usaha kecil',
                'monthly_cost' => 30000,
                'installation_cost' => 750000,
                'security_deposit' => 200000,
                'minimum_usage' => 20,
                'meter_size' => '3/4 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => now(),
                'notes' => 'Biaya untuk pelanggan komersial'
            ],
            [
                'category_name' => 'Komersial',
                'description' => 'Pelanggan komersial dengan meter 1 inch',
                'monthly_cost' => 45000,
                'installation_cost' => 1000000,
                'security_deposit' => 300000,
                'minimum_usage' => 25,
                'meter_size' => '1 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => now(),
                'notes' => 'Biaya untuk pelanggan komersial meter besar'
            ],
            [
                'category_name' => 'Industri',
                'description' => 'Pelanggan industri kecil dan menengah',
                'monthly_cost' => 75000,
                'installation_cost' => 1500000,
                'security_deposit' => 500000,
                'minimum_usage' => 50,
                'meter_size' => '1.5 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => now(),
                'notes' => 'Biaya untuk pelanggan industri'
            ],
            [
                'category_name' => 'Sosial',
                'description' => 'Pelanggan sosial (sekolah, puskesmas, dll)',
                'monthly_cost' => 10000,
                'installation_cost' => 300000,
                'security_deposit' => 50000,
                'minimum_usage' => 8,
                'meter_size' => '1/2 inch',
                'connection_type' => 'new',
                'is_active' => true,
                'effective_date' => now(),
                'notes' => 'Biaya khusus untuk pelanggan sosial'
            ],
            [
                'category_name' => 'Rumah Tangga',
                'description' => 'Upgrade meter dari 1/2 inch ke 3/4 inch',
                'monthly_cost' => 5000,
                'installation_cost' => 150000,
                'security_deposit' => 50000,
                'minimum_usage' => 0,
                'meter_size' => '3/4 inch',
                'connection_type' => 'upgrade',
                'is_active' => true,
                'effective_date' => now(),
                'notes' => 'Biaya tambahan untuk upgrade meter'
            ],
            [
                'category_name' => 'Komersial',
                'description' => 'Penggantian meter rusak',
                'monthly_cost' => 0,
                'installation_cost' => 200000,
                'security_deposit' => 0,
                'minimum_usage' => 0,
                'meter_size' => 'Sama dengan sebelumnya',
                'connection_type' => 'replacement',
                'is_active' => true,
                'effective_date' => now(),
                'notes' => 'Biaya penggantian meter yang rusak'
            ]
        ];

        foreach ($fixedCosts as $fixedCost) {
            FixedCost::create($fixedCost);
        }
    }
}
