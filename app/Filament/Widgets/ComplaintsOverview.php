<?php

namespace App\Filament\Widgets;

use App\Models\OnlineComplaint;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class ComplaintsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalComplaints = OnlineComplaint::count();
        $pendingComplaints = OnlineComplaint::where('status', 'pending')->count();
        $inProgressComplaints = OnlineComplaint::where('status', 'in_progress')->count();
        $resolvedComplaints = OnlineComplaint::where('status', 'resolved')->count();
        $todayComplaints = OnlineComplaint::whereDate('created_at', Carbon::today())->count();
        $thisWeekComplaints = OnlineComplaint::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();

        return [
            Stat::make('Total Pengaduan', $totalComplaints)
                ->description('Semua pengaduan yang masuk')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Pending', $pendingComplaints)
                ->description('Menunggu tindakan')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Diproses', $inProgressComplaints)
                ->description('Sedang ditangani')
                ->descriptionIcon('heroicon-m-cog-6-tooth')
                ->color('info'),

            Stat::make('Selesai', $resolvedComplaints)
                ->description('Sudah diselesaikan')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Hari Ini', $todayComplaints)
                ->description('Pengaduan masuk hari ini')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('gray'),

            Stat::make('Minggu Ini', $thisWeekComplaints)
                ->description('Pengaduan minggu ini')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('gray'),
        ];
    }
}
