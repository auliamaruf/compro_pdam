<?php

namespace App\Filament\Widgets;

use App\Models\News;
use App\Models\OnlineComplaint;
use App\Models\ContactMessage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class RecentActivities extends BaseWidget
{
    protected ?string $heading = 'Aktivitas Editorial Terbaru';
    protected static ?int $sort = 5;

    protected function getStats(): array
    {
        // Hitung aktivitas 7 hari terakhir
        $recentNews = News::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $recentComplaints = OnlineComplaint::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $recentMessages = ContactMessage::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        
        // Hitung aktivitas hari ini
        $todayNews = News::whereDate('created_at', Carbon::today())->count();
        $todayComplaints = OnlineComplaint::whereDate('created_at', Carbon::today())->count();
        $todayMessages = ContactMessage::whereDate('created_at', Carbon::today())->count();

        return [
            Stat::make('Berita 7 Hari', $recentNews)
                ->description("Hari ini: {$todayNews}")
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('info')
                ->chart([3, 5, 2, 7, 4, 6, $recentNews]),

            Stat::make('Pengaduan 7 Hari', $recentComplaints)
                ->description("Hari ini: {$todayComplaints}")
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($recentComplaints > 10 ? 'danger' : 'warning')
                ->chart([2, 4, 1, 5, 3, 4, $recentComplaints]),

            Stat::make('Pesan 7 Hari', $recentMessages)
                ->description("Hari ini: {$todayMessages}")
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('primary')
                ->chart([1, 3, 2, 4, 2, 3, $recentMessages]),

            Stat::make('Total Aktivitas', $recentNews + $recentComplaints + $recentMessages)
                ->description('Gabungan 7 hari terakhir')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color('success'),
        ];
    }
}
