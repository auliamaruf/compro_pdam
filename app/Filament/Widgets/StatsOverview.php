<?php

namespace App\Filament\Widgets;

use App\Models\News;
use App\Models\Service;
use App\Models\Comment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Berita', News::count())
                ->description('Berita & Pengumuman')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success'),

            Stat::make('Layanan Aktif', Service::where('is_active', true)->count())
                ->description('Layanan PDAM')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('info'),

            Stat::make('Komentar Pending', Comment::where('status', 'pending')->count())
                ->description('Menunggu Moderasi')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('warning'),

            Stat::make('Pengunjung Hari Ini', '1,234')
                ->description('Unique visitors')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
        ];
    }
}
