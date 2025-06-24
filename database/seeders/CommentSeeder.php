<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\News;
use App\Models\Service;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $news = News::take(5)->get();
        $services = Service::take(3)->get();        $comments = [
            // Komentar untuk berita
            [
                'author_name' => 'Budi Santoso',
                'author_email' => 'budi.santoso@email.com',
                'content' => 'Alhamdulillah, akhirnya kualitas air di daerah kami membaik. Terima kasih PDAM Tirta Perwira atas investasi yang dilakukan. Semoga kedepannya semakin berkualitas.',
                'commentable_type' => 'App\Models\News',
                'commentable_id' => $news->first()->id ?? 1,
                'status' => 'approved',
                'approved_at' => now(),
                'created_at' => now()->subDays(1),
            ],
            [
                'author_name' => 'Siti Nurhaliza',
                'author_email' => 'siti.nurhaliza@email.com',
                'author_phone' => '081234567890',
                'content' => 'Kantor layanan baru di Bobotsari sangat membantu masyarakat. Tidak perlu jauh-jauh ke kantor pusat lagi. Pelayanannya juga ramah dan cepat.',
                'commentable_type' => 'App\Models\News',
                'commentable_id' => $news->skip(1)->first()->id ?? 2,
                'status' => 'approved',
                'approved_at' => now(),
                'created_at' => now()->subDays(2),
            ],
            [
                'author_name' => 'Ahmad Hidayat',
                'author_email' => 'ahmad.hidayat@email.com',
                'content' => 'Program CSR untuk desa terpencil ini sangat bagus. Sebagai warga Desa Kalimanah, kami merasa sangat terbantu dengan adanya sumur bor yang dibangun PDAM.',
                'commentable_type' => 'App\Models\News',
                'commentable_id' => $news->skip(2)->first()->id ?? 3,
                'status' => 'approved',
                'approved_at' => now(),
                'created_at' => now()->subDays(3),
            ],
            [
                'author_name' => 'Rina Marlina',
                'author_email' => 'rina.marlina@email.com',
                'content' => 'Informasi jadwal pemeliharaan sangat membantu untuk persiapan. Mohon selalu diinformasikan sebelumnya ya agar kami bisa menyiapkan cadangan air.',
                'commentable_type' => 'App\Models\News',
                'commentable_id' => $news->skip(3)->first()->id ?? 4,
                'status' => 'approved',
                'approved_at' => now(),
                'created_at' => now()->subDays(1),
            ],
            [
                'author_name' => 'Dedi Kurniawan',
                'author_email' => 'dedi.kurniawan@email.com',
                'content' => 'Kerjasama dengan Unsoed ini bagus untuk pengembangan teknologi. Semoga bisa menghasilkan inovasi baru dalam pengolahan air yang lebih efisien.',
                'commentable_type' => 'App\Models\News',
                'commentable_id' => $news->skip(4)->first()->id ?? 5,
                'status' => 'approved',
                'approved_at' => now(),
                'created_at' => now()->subDays(4),
            ],
            [
                'author_name' => 'Eka Putri',
                'author_email' => 'eka.putri@email.com',
                'content' => 'Kenaikan tarif memang tidak bisa dihindari, tapi semoga dengan kenaikan ini kualitas dan pelayanan semakin membaik. Mohon tetap pertimbangkan kemampuan masyarakat.',
                'commentable_type' => 'App\Models\News',
                'commentable_id' => $news->first()->id ?? 1,
                'status' => 'approved',
                'approved_at' => now(),
                'created_at' => now()->subHours(12),
            ],
            [
                'author_name' => 'Fajar Nugroho',
                'author_email' => 'fajar.nugroho@email.com',
                'content' => 'Workshop konservasi air untuk pelajar ini sangat edukatif. Anak saya ikut dan jadi lebih sadar pentingnya menghemat air. Terima kasih PDAM.',
                'commentable_type' => 'App\Models\News',
                'commentable_id' => $news->skip(1)->first()->id ?? 2,
                'status' => 'approved',
                'approved_at' => now(),
                'created_at' => now()->subHours(8),
            ],
            [
                'author_name' => 'Novi Lestari',
                'author_email' => 'novi.lestari@email.com',
                'content' => 'Sistem pembayaran digital sangat memudahkan. Sekarang bisa bayar tagihan kapan saja tanpa perlu datang ke kantor. Aplikasinya juga user-friendly.',
                'commentable_type' => 'App\Models\News',
                'commentable_id' => $news->skip(2)->first()->id ?? 3,
                'status' => 'approved',
                'approved_at' => now(),
                'created_at' => now()->subHours(6),
            ],

            // Komentar untuk layanan
            [
                'author_name' => 'Yudi Pratama',
                'author_email' => 'yudi.pratama@email.com',
                'content' => 'Proses pemasangan sambungan baru sangat cepat dan profesional. Tim teknisi PDAM sangat ramah dan menjelaskan semua prosedur dengan baik. Recommended!',
                'commentable_type' => 'App\Models\Service',
                'commentable_id' => $services->first()->id ?? 1,
                'status' => 'approved',
                'approved_at' => now(),
                'created_at' => now()->subDays(5),
            ],
            [
                'author_name' => 'Indah Permata',
                'author_email' => 'indah.permata@email.com',
                'content' => 'Pelayanan perbaikan meter air sangat responsif. Saya lapor pagi, sore sudah diperbaiki. Terima kasih untuk pelayanan yang memuaskan.',
                'commentable_type' => 'App\Models\Service',
                'commentable_id' => $services->skip(1)->first()->id ?? 2,
                'status' => 'approved',
                'approved_at' => now(),
                'created_at' => now()->subDays(3),
            ],
            [
                'author_name' => 'Hendra Wijaya',
                'author_email' => 'hendra.wijaya@email.com',
                'content' => 'Customer service PDAM sangat membantu dalam menangani keluhan kualitas air. Respon cepat dan follow up yang baik sampai masalah selesai.',
                'commentable_type' => 'App\Models\Service',
                'commentable_id' => $services->skip(2)->first()->id ?? 3,
                'status' => 'approved',
                'approved_at' => now(),
                'created_at' => now()->subDays(2),
            ],
            [
                'author_name' => 'Maya Sari',
                'author_email' => 'maya.sari@email.com',
                'content' => 'Untuk sambungan komersial, prosesnya memang agak lama tapi hasilnya memuaskan. Semua persyaratan dijelaskan dengan detail dan tidak ada biaya tersembunyi.',
                'commentable_type' => 'App\Models\Service',
                'commentable_id' => $services->first()->id ?? 1,
                'status' => 'approved',
                'approved_at' => now(),
                'created_at' => now()->subDays(1),
            ],
            [
                'author_name' => 'Rizki Abdullah',
                'author_email' => 'rizki.abdullah@email.com',
                'content' => 'Emergency service untuk perbaikan pipa bocor sangat baik. Tim teknis datang dengan cepat dan menangani kebocoran dengan profesional.',
                'commentable_type' => 'App\Models\Service',
                'commentable_id' => $services->skip(1)->first()->id ?? 2,
                'status' => 'approved',
                'approved_at' => now(),
                'created_at' => now()->subHours(18),
            ],

            // Komentar pending moderasi
            [
                'author_name' => 'Anonymous User',
                'author_email' => 'anonymous@email.com',
                'content' => 'Tarif terlalu mahal untuk kualitas air yang biasa saja.',
                'commentable_type' => 'App\Models\News',
                'commentable_id' => $news->first()->id ?? 1,
                'status' => 'pending',
                'created_at' => now()->subHours(2),
            ],

            // Komentar yang direject
            [
                'author_name' => 'Spam User',
                'author_email' => 'spam@email.com',
                'content' => 'Ini spam comment untuk testing',
                'commentable_type' => 'App\Models\News',
                'commentable_id' => $news->first()->id ?? 1,
                'status' => 'rejected',
                'created_at' => now()->subHours(1),
            ],
        ];

        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}
