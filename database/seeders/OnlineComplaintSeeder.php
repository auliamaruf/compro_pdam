<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OnlineComplaint;
use Carbon\Carbon;

class OnlineComplaintSeeder extends Seeder
{
    public function run(): void
    {
        $complaints = [
            [
                'customer_name' => 'Budi Santoso',
                'customer_id_number' => 'PLG001234',
                'email' => 'budi.santoso@email.com',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 123, Purbalingga',
                'complaint_type' => 'water_quality',
                'subject' => 'Air keruh dan berbau',
                'description' => 'Air PDAM yang keluar dari keran rumah saya keruh dan mengeluarkan bau yang tidak sedap. Hal ini sudah berlangsung selama 3 hari. Mohon segera ditindaklanjuti.',
                'priority' => 'high',
                'status' => 'pending',
                'ip_address' => '192.168.1.100',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => Carbon::now()->subDays(1),
            ],
            [
                'customer_name' => 'Siti Aminah',
                'customer_id_number' => 'PLG005678',
                'email' => 'siti.aminah@email.com',
                'phone' => '082345678901',
                'address' => 'Jl. Sudirman No. 456, Purbalingga',
                'complaint_type' => 'water_pressure',
                'subject' => 'Tekanan air sangat lemah',
                'description' => 'Tekanan air di rumah saya sangat lemah, terutama pada lantai 2. Air hanya menetes dari keran. Sudah beberapa minggu seperti ini.',
                'priority' => 'medium',
                'status' => 'in_progress',
                'admin_response' => 'Keluhan Anda telah kami terima dan sedang ditindaklanjuti oleh tim teknis kami. Terima kasih atas kesabaran Anda.',
                'responded_at' => Carbon::now()->subHours(6),
                'assigned_to' => 1,
                'ip_address' => '192.168.1.101',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'created_at' => Carbon::now()->subDays(3),
            ],
            [
                'customer_name' => 'Ahmad Rahman',
                'customer_id_number' => 'PLG009876',
                'email' => 'ahmad.rahman@email.com',
                'phone' => '083456789012',
                'address' => 'Jl. Gatot Subroto No. 789, Purbalingga',
                'complaint_type' => 'billing',
                'subject' => 'Tagihan tidak sesuai pemakaian',
                'description' => 'Tagihan bulan ini sangat tinggi padahal pemakaian air tidak berubah. Mohon dicek kembali meteran dan perhitungan tagihannya.',
                'priority' => 'medium',
                'status' => 'resolved',
                'admin_response' => 'Setelah dilakukan pengecekan, ditemukan ada kesalahan dalam pembacaan meteran. Tagihan telah diperbaiki dan akan direfleksikan di tagihan bulan depan. Terima kasih atas laporannya.',
                'responded_at' => Carbon::now()->subDays(1),
                'resolved_at' => Carbon::now()->subDays(1),
                'assigned_to' => 1,
                'ip_address' => '192.168.1.102',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'customer_name' => 'Dewi Kartika',
                'customer_id_number' => 'PLG002468',
                'email' => 'dewi.kartika@email.com',
                'phone' => '084567890123',
                'address' => 'Jl. Diponegoro No. 321, Purbalingga',
                'complaint_type' => 'pipe_damage',
                'subject' => 'Pipa bocor di depan rumah',
                'description' => 'Ada kebocoran pipa air besar di depan rumah saya. Air keluar terus menerus dan menggenang di jalan. Mohon segera diperbaiki.',
                'priority' => 'urgent',
                'status' => 'pending',
                'ip_address' => '192.168.1.103',
                'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 14_0 like Mac OS X) AppleWebKit/605.1.15',
                'created_at' => Carbon::now()->subHours(2),
            ],
            [
                'customer_name' => 'Rudi Hermawan',
                'customer_id_number' => 'PLG013579',
                'email' => 'rudi.hermawan@email.com',
                'phone' => '085678901234',
                'address' => 'Jl. Ahmad Yani No. 654, Purbalingga',
                'complaint_type' => 'service_connection',
                'subject' => 'Pengajuan sambungan baru',
                'description' => 'Saya ingin mengajukan sambungan air baru untuk rumah yang baru selesai dibangun. Mohon informasi prosedur dan biayanya.',
                'priority' => 'low',
                'status' => 'in_progress',
                'admin_response' => 'Terima kasih atas pengajuan sambungan baru. Tim survey akan datang ke lokasi dalam 2-3 hari kerja untuk pengecekan kelayakan. Silakan siapkan dokumen yang diperlukan.',
                'responded_at' => Carbon::now()->subHours(12),
                'assigned_to' => 1,
                'ip_address' => '192.168.1.104',
                'user_agent' => 'Mozilla/5.0 (Android 11; Mobile; rv:68.0) Gecko/68.0 Firefox/88.0',
                'created_at' => Carbon::now()->subDays(2),
            ]
        ];

        foreach ($complaints as $complaint) {
            OnlineComplaint::create($complaint);
        }
    }
}
