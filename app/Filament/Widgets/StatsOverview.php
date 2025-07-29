<?php

namespace App\Filament\Widgets;

use App\Models\News;
use App\Models\Service;
use App\Models\Comment;
use App\Models\ContactMessage;
use App\Models\OnlineComplaint;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalNews = News::count();
        $publishedNews = News::where('status', 'published')->count();
        $draftNews = News::where('status', 'draft')->count();
        $totalServices = Service::count();
        $activeServices = Service::where('is_active', true)->count();
        $pendingComments = Comment::where('status', 'pending')->count();
        $totalComplaints = OnlineComplaint::count();
        $newComplaints = OnlineComplaint::where('status', 'pending')->count();
        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();
        $totalUsers = User::count();

        // Chart data untuk trend konten 7 hari terakhir
        $newsChart = [];
        $servicesChart = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $newsChart[] = News::whereDate('created_at', $date)->count();
            $servicesChart[] = Service::whereDate('updated_at', $date)->count();
        }

        return [
            Stat::make('Konten Berita', $publishedNews)
                ->description("Draft: {$draftNews} | Total: {$totalNews}")
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success')
                ->chart($newsChart)
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),

            Stat::make('Layanan Tersedia', $activeServices)
                ->description("Total: {$totalServices} layanan")
                ->descriptionIcon('heroicon-m-cog-6-tooth')
                ->color('info')
                ->chart($servicesChart),

            Stat::make('Komentar Moderasi', $pendingComments)
                ->description('Menunggu persetujuan')
                ->descriptionIcon('heroicon-m-chat-bubble-bottom-center-text')
                ->color($pendingComments > 5 ? 'warning' : 'gray'),

            Stat::make('Pengaduan Baru', $newComplaints)
                ->description("Total: {$totalComplaints} pengaduan")
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($newComplaints > 5 ? 'danger' : 'primary'),

            Stat::make('Pesan Belum Dibaca', $unreadMessages)
                ->description("Total: {$totalMessages} pesan")
                ->descriptionIcon('heroicon-m-envelope')
                ->color($unreadMessages > 0 ? 'warning' : 'success'),

            Stat::make('Editor & Admin', $totalUsers)
                ->description('Pengelola konten')
                ->descriptionIcon('heroicon-m-users')
                ->color('secondary'),
        ];
    }
}
