<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\OrganizationStructure;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks temporarily
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();
        
        // Clear existing data
        Branch::truncate();
        
        // Re-enable foreign key checks
        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();
        
        // Get kepala cabang IDs from organization structure
        $kepalaCabangKota = OrganizationStructure::where('title', 'Kepala Cabang Kota')->first();
        $kepalaCabangJenderal = OrganizationStructure::where('title', 'Kepala Cabang Jenderal Soedirman')->first();
        $kepalaCabangUsman = OrganizationStructure::where('title', 'Kepala Cabang Usman Janatin')->first();
        $kepalaCabangGoentoer = OrganizationStructure::where('title', 'Kepala Cabang Goentoer Darjono')->first();
        $kepalaCabangArdilawet = OrganizationStructure::where('title', 'Kepala Cabang Ardilawet')->first();
        
        // Get kepala unit IKK IDs from organization structure
        $kepalaUnitKemangkon = OrganizationStructure::where('title', 'Kepala Unit IKK Kemangkon')->first();
        $kepalaUnitRembang = OrganizationStructure::where('title', 'Kepala Unit IKK Rembang')->first();
        $kepalaUnitKarangreja = OrganizationStructure::where('title', 'Kepala Unit IKK Karangreja')->first();
        
        $branches = [
            // CABANG REGULAR
            [
                'name' => 'Cabang Kota Purbalingga',
                'branch_type' => 'cabang',
                'code' => 'CBG-001',
                'address' => 'Jl. Letjend S. Parman No. 53, Purbalingga Wetan, Kec. Purbalingga, Kabupaten Purbalingga, Jawa Tengah 53311',
                'phone' => '(0281) 891234',
                'email' => 'cabang.kota@tirtaperwira.com',
                'google_maps_url' => 'https://goo.gl/maps/3xK4jQwVrKMk9gqz8',
                'head_of_branch_id' => $kepalaCabangKota?->id,
                'office_hours_weekday' => '07:30 - 15:00',
                'office_hours_friday' => '07:30 - 11:00',
                'office_hours_saturday' => '07:30 - 13:00',
                'office_hours_sunday' => 'Tutup',
                'description' => 'Cabang utama PDAM Tirta Perwira yang melayani wilayah pusat kota Purbalingga dengan fasilitas pelayanan lengkap.',
                'services' => [
                    'Pendaftaran sambungan baru',
                    'Pembayaran rekening air',
                    'Pengaduan pelanggan',
                    'Informasi tarif air',
                    'Konsultasi teknis'
                ],
                'coverage_areas' => [
                    'Purbalingga Wetan',
                    'Purbalingga Lor',
                    'Kembaran',
                    'Kejobong'
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Cabang Jenderal Soedirman',
                'branch_type' => 'cabang',
                'code' => 'CBG-002',
                'address' => 'Jl. Jenderal Soedirman No. 125, Purbalingga, Jawa Tengah',
                'phone' => '(0281) 891567',
                'email' => 'cabang.soedirman@tirtaperwira.com',
                'google_maps_url' => 'https://goo.gl/maps/2xK4jQwVrKMk9gqz9',
                'head_of_branch_id' => $kepalaCabangJenderal?->id,
                'office_hours_weekday' => '07:30 - 15:00',
                'office_hours_friday' => '07:30 - 11:00',
                'office_hours_saturday' => '07:30 - 13:00',
                'office_hours_sunday' => 'Tutup',
                'description' => 'Cabang pelayanan yang strategis di jalan utama kota, melayani masyarakat dengan akses mudah.',
                'services' => [
                    'Pembayaran rekening air',
                    'Pengaduan pelanggan',
                    'Informasi tarif',
                    'Pendaftaran sambungan baru'
                ],
                'coverage_areas' => [
                    'Jalan Jenderal Soedirman',
                    'Sekitar pasar tradisional',
                    'Perumahan Soedirman'
                ],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Cabang Usman Janatin',
                'branch_type' => 'cabang',
                'code' => 'CBG-003',
                'address' => 'Jl. Usman Janatin No. 87, Purbalingga, Jawa Tengah',
                'phone' => '(0281) 891890',
                'email' => 'cabang.usman@tirtaperwira.com',
                'google_maps_url' => 'https://goo.gl/maps/4xK4jQwVrKMk9gqz7',
                'head_of_branch_id' => $kepalaCabangUsman?->id,
                'office_hours_weekday' => '07:30 - 15:00',
                'office_hours_friday' => '07:30 - 11:00',
                'office_hours_saturday' => '07:30 - 13:00',
                'office_hours_sunday' => 'Tutup',
                'description' => 'Cabang yang melayani wilayah sekitar Jalan Usman Janatin dengan fokus pelayanan masyarakat.',
                'services' => [
                    'Pembayaran rekening',
                    'Konsultasi teknis',
                    'Pengaduan'
                ],
                'coverage_areas' => [
                    'Jalan Usman Janatin',
                    'Perumahan sekitar',
                    'Kompleks perkantoran'
                ],
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Cabang Goentoer Darjono',
                'branch_type' => 'cabang',
                'code' => 'CBG-004',
                'address' => 'Jl. Goentoer Darjono No. 45, Purbalingga, Jawa Tengah',
                'phone' => '(0281) 892123',
                'email' => 'cabang.goentoer@tirtaperwira.com',
                'google_maps_url' => 'https://goo.gl/maps/5xK4jQwVrKMk9gqz6',
                'head_of_branch_id' => $kepalaCabangGoentoer?->id,
                'office_hours_weekday' => '07:30 - 15:00',
                'office_hours_friday' => '07:30 - 11:00',
                'office_hours_saturday' => '07:30 - 13:00',
                'office_hours_sunday' => 'Tutup',
                'description' => 'Cabang dengan lokasi strategis yang mudah dijangkau masyarakat sekitar.',
                'services' => [
                    'Layanan pelanggan',
                    'Pembayaran tagihan',
                    'Informasi layanan'
                ],
                'coverage_areas' => [
                    'Jalan Goentoer Darjono',
                    'Area sekitar'
                ],
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Cabang Ardilawet',
                'branch_type' => 'cabang',
                'code' => 'CBG-005',
                'address' => 'Jl. Ardilawet No. 32, Purbalingga, Jawa Tengah',
                'phone' => '(0281) 892456',
                'email' => 'cabang.ardilawet@tirtaperwira.com',
                'google_maps_url' => 'https://goo.gl/maps/6xK4jQwVrKMk9gqz5',
                'head_of_branch_id' => $kepalaCabangArdilawet?->id,
                'office_hours_weekday' => '07:30 - 15:00',
                'office_hours_friday' => '07:30 - 11:00',
                'office_hours_saturday' => '07:30 - 13:00',
                'office_hours_sunday' => 'Tutup',
                'description' => 'Cabang Ardilawet melayani masyarakat dengan standar pelayanan terbaik.',
                'services' => [
                    'Pelayanan umum',
                    'Pembayaran',
                    'Pengaduan'
                ],
                'coverage_areas' => [
                    'Jalan Ardilawet',
                    'Sekitar wilayah'
                ],
                'is_active' => true,
                'sort_order' => 5,
            ],
            
            // UNIT IKK
            [
                'name' => 'Unit IKK Kemangkon',
                'branch_type' => 'unit_ikk',
                'code' => 'IKK-001',
                'address' => 'Jl. Raya Kemangkon No. 25, Kemangkon, Purbalingga, Jawa Tengah',
                'phone' => '(0281) 893001',
                'email' => 'ikk.kemangkon@tirtaperwira.com',
                'google_maps_url' => 'https://goo.gl/maps/7xK4jQwVrKMk9gqz4',
                'head_of_branch_id' => $kepalaUnitKemangkon?->id,
                'office_hours_weekday' => '07:30 - 15:00',
                'office_hours_friday' => '07:30 - 11:00',
                'office_hours_saturday' => '07:30 - 13:00',
                'office_hours_sunday' => 'Tutup',
                'description' => 'Unit IKK Kemangkon melayani wilayah Kemangkon dan sekitarnya dengan fokus pada distribusi air bersih dan pelayanan masyarakat.',
                'services' => [
                    'Pendaftaran sambungan baru',
                    'Pembayaran rekening air',
                    'Pengaduan pelanggan',
                    'Pemeliharaan jaringan distribusi'
                ],
                'coverage_areas' => [
                    'Kecamatan Kemangkon',
                    'Desa-desa sekitar Kemangkon'
                ],
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Unit IKK Rembang',
                'branch_type' => 'unit_ikk',
                'code' => 'IKK-002',
                'address' => 'Jl. Raya Rembang No. 18, Rembang, Purbalingga, Jawa Tengah',
                'phone' => '(0281) 893002',
                'email' => 'ikk.rembang@tirtaperwira.com',
                'google_maps_url' => 'https://goo.gl/maps/8xK4jQwVrKMk9gqz3',
                'head_of_branch_id' => $kepalaUnitRembang?->id,
                'office_hours_weekday' => '07:30 - 15:00',
                'office_hours_friday' => '07:30 - 11:00',
                'office_hours_saturday' => '07:30 - 13:00',
                'office_hours_sunday' => 'Tutup',
                'description' => 'Unit IKK Rembang berkomitmen memberikan pelayanan air bersih terbaik untuk masyarakat Rembang dan sekitarnya.',
                'services' => [
                    'Pelayanan sambungan air',
                    'Pembayaran tagihan',
                    'Konsultasi teknis',
                    'Monitoring kualitas air'
                ],
                'coverage_areas' => [
                    'Kecamatan Rembang',
                    'Wilayah sekitar Rembang'
                ],
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'Unit IKK Karangreja',
                'branch_type' => 'unit_ikk',
                'code' => 'IKK-003',
                'address' => 'Jl. Karangreja Utara No. 12, Karangreja, Purbalingga, Jawa Tengah',
                'phone' => '(0281) 893003',
                'email' => 'ikk.karangreja@tirtaperwira.com',
                'google_maps_url' => 'https://goo.gl/maps/9xK4jQwVrKMk9gqz2',
                'head_of_branch_id' => $kepalaUnitKarangreja?->id,
                'office_hours_weekday' => '07:30 - 15:00',
                'office_hours_friday' => '07:30 - 11:00',
                'office_hours_saturday' => '07:30 - 13:00',
                'office_hours_sunday' => 'Tutup',
                'description' => 'Unit IKK Karangreja melayani distribusi air bersih dan berbagai kebutuhan pelanggan di wilayah Karangreja.',
                'services' => [
                    'Layanan sambungan baru',
                    'Pembayaran rekening',
                    'Penanganan pengaduan',
                    'Pemeliharaan infrastruktur'
                ],
                'coverage_areas' => [
                    'Kecamatan Karangreja',
                    'Desa-desa di sekitar Karangreja'
                ],
                'is_active' => true,
                'sort_order' => 8,
            ],
        ];

        foreach ($branches as $branchData) {
            Branch::create($branchData);
        }
    }
}
