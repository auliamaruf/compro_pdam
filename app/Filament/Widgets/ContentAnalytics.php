<?php

namespace App\Filament\Widgets;

use App\Models\News;
use App\Models\Service;
use App\Models\ContactMessage;
use App\Models\OnlineComplaint;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class ContentAnalytics extends BaseWidget
{
    protected ?string $heading = 'Analisis Konten & Engagement';
    protected static ?int $sort = 4;
    
    protected function getStats(): array
    {
        // Konten yang paling banyak dilihat
        $mostViewedNews = News::orderBy('views', 'desc')->first();
        $totalViews = News::sum('views') ?? 0;
        
        // Konten trending minggu ini
        $weeklyNews = News::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $weeklyServices = Service::where('updated_at', '>=', Carbon::now()->subDays(7))->count();
        
        // Engagement metrics
        $activeContent = News::where('status', 'published')->count() + Service::where('is_active', true)->count();
        $draftContent = News::where('status', 'draft')->count();
        
        // Response rate
        $messagesThisMonth = ContactMessage::whereMonth('created_at', Carbon::now()->month)->count();
        $complaintsThisMonth = OnlineComplaint::whereMonth('created_at', Carbon::now()->month)->count();

        return [
            Stat::make('Total Views', number_format($totalViews))
                ->description($mostViewedNews ? "Terpopuler: {$mostViewedNews->title}" : 'Belum ada data views')
                ->descriptionIcon('heroicon-m-eye')
                ->color('success'),

            Stat::make('Konten Aktif', $activeContent)
                ->description("Draft: {$draftContent}")
                ->descriptionIcon('heroicon-m-document-check')
                ->color('primary'),

            Stat::make('Update Minggu Ini', $weeklyNews + $weeklyServices)
                ->description("Berita: {$weeklyNews} | Layanan: {$weeklyServices}")
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('info'),

            Stat::make('Interaksi Bulan Ini', $messagesThisMonth + $complaintsThisMonth)
                ->description("Pesan: {$messagesThisMonth} | Pengaduan: {$complaintsThisMonth}")
                ->descriptionIcon('heroicon-m-chat-bubble-left-ellipsis')
                ->color('warning'),
        ];
    }
}
