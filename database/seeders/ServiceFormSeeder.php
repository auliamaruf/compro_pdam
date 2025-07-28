<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update Sambungan Baru service
        $sambunganBaruService = Service::updateOrCreate(
            ['slug' => 'sambungan-baru'],
            [
                'name' => 'Sambungan Baru',
                'description' => 'Layanan pemasangan sambungan air bersih untuk rumah tangga, komersial, dan industri',
                'icon' => 'fas fa-faucet',
                'category' => 'new_connection',
                'requirements' => [
                    ['requirement' => 'Fotokopi KTP yang masih berlaku'],
                    ['requirement' => 'Fotokopi Kartu Keluarga'],
                    ['requirement' => 'Surat keterangan domisili dari RT/RW'],
                    ['requirement' => 'Sertifikat atau surat kepemilikan tanah'],
                    ['requirement' => 'IMB (Izin Mendirikan Bangunan)'],
                    ['requirement' => 'Denah lokasi pemasangan sambungan'],
                ],
                'process_time' => '7-14 hari kerja',
                'fee' => 850000.00,
                'procedure' => '<p>Prosedur pemasangan sambungan baru:</p>
                    <ol>
                        <li>Datang ke kantor PDAM dengan membawa persyaratan lengkap</li>
                        <li>Mengisi formulir permohonan sambungan baru</li>
                        <li>Melakukan pembayaran biaya pemasangan</li>
                        <li>Survey lokasi oleh tim teknis</li>
                        <li>Pemasangan sambungan dan meter air</li>
                        <li>Aktivasi layanan</li>
                    </ol>',
                'contact_person' => 'Bagian Pemasangan',
                'contact_phone' => '0281-891234',
                'forms' => [
                    [
                        'title' => 'Formulir Sambungan Rumah Tangga',
                        'url' => 'https://drive.google.com/file/d/1234567890/view?usp=sharing',
                        'description' => 'Format PDF • 250 KB'
                    ],
                    [
                        'title' => 'Formulir Sambungan Komersial',
                        'url' => 'https://drive.google.com/file/d/0987654321/view?usp=sharing',
                        'description' => 'Format PDF • 320 KB'
                    ]
                ],
                'sort_order' => 1,
                'is_active' => true,
                'is_featured' => true,
                'show_in_navbar' => true,
                'navbar_order' => 1,
                'navbar_label' => 'Sambungan Baru',
                'navbar_icon' => 'fas fa-plus-circle',
                'is_navbar_featured' => true
            ]
        );

        // Create other sample services
        $services = [
            [
                'name' => 'Perbaikan Sambungan',
                'slug' => 'perbaikan-sambungan',
                'description' => 'Layanan perbaikan sambungan air yang rusak atau bermasalah',
                'icon' => 'fas fa-tools',
                'category' => 'technical',
                'forms' => [
                    [
                        'title' => 'Formulir Perbaikan Sambungan',
                        'url' => 'https://drive.google.com/file/d/form-perbaikan/view?usp=sharing',
                        'description' => 'Format PDF • 180 KB'
                    ]
                ]
            ],
            [
                'name' => 'Penutupan Sambungan',
                'slug' => 'penutupan-sambungan',
                'description' => 'Layanan penutupan sambungan air sementara atau permanen',
                'icon' => 'fas fa-ban',
                'category' => 'customer_service',
                'forms' => [
                    [
                        'title' => 'Formulir Penutupan Sambungan',
                        'url' => 'https://drive.google.com/file/d/form-penutupan/view?usp=sharing',
                        'description' => 'Format PDF • 200 KB'
                    ]
                ]
            ],
            [
                'name' => 'Layanan Pengaduan',
                'slug' => 'layanan-pengaduan',
                'description' => 'Layanan pengaduan untuk masalah kualitas air, tagihan, atau pelayanan',
                'icon' => 'fas fa-headset',
                'category' => 'customer_service',
                'forms' => []
            ]
        ];

        foreach ($services as $serviceData) {
            Service::updateOrCreate(
                ['slug' => $serviceData['slug']],
                array_merge($serviceData, [
                    'requirements' => [
                        ['requirement' => 'Fotokopi KTP yang masih berlaku'],
                        ['requirement' => 'Surat permohonan bermaterai'],
                    ],
                    'process_time' => '3-5 hari kerja',
                    'fee' => 0.00,
                    'procedure' => '<p>Prosedur ' . $serviceData['name'] . ':</p>
                        <ol>
                            <li>Datang ke kantor PDAM dengan membawa persyaratan</li>
                            <li>Mengisi formulir permohonan</li>
                            <li>Proses verifikasi data</li>
                            <li>Pelaksanaan layanan</li>
                        </ol>',
                    'contact_person' => 'Customer Service',
                    'contact_phone' => '0281-891234',
                    'sort_order' => 10,
                    'is_active' => true,
                    'is_featured' => false,
                    'show_in_navbar' => false,
                ])
            );
        }

        $this->command->info('Service forms seeded successfully!');
        $this->command->info('Sambungan Baru service created with external form links.');
        $this->command->info('You can now upload PDF files via the admin panel or use external links.');
    }
}
