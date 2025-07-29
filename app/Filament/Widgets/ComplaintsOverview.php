<?php

namespace App\Filament\Widgets;

use App\Models\OnlineComplaint;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class ComplaintsOverview extends BaseWidget
{
    protected ?string $heading = 'Pengelolaan Pengaduan & Feedback';
    protected static ?int $sort = 3;
    
    protected function getStats(): array
    {
        $totalComplaints = OnlineComplaint::count();
        $pendingComplaints = OnlineComplaint::where('status', 'pending')->count();
        $inProgressComplaints = OnlineComplaint::where('status', 'in_progress')->count();
        $resolvedComplaints = OnlineComplaint::where('status', 'resolved')->count();
        $todayComplaints = OnlineComplaint::whereDate('created_at', Carbon::today())->count();
        $thisWeekComplaints = OnlineComplaint::where('created_at', '>=', Carbon::now()->subDays(7))->count();

        return [
            Stat::make('Pengaduan Baru', $pendingComplaints)
                ->description('Memerlukan tindak lanjut')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->color($pendingComplaints > 5 ? 'danger' : 'warning'),

            Stat::make('Dalam Proses', $inProgressComplaints)
                ->description('Sedang ditangani')
                ->descriptionIcon('heroicon-m-clock')
                ->color('info'),

            Stat::make('Telah Selesai', $resolvedComplaints)
                ->description("dari {$totalComplaints} total")
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Minggu Ini', $thisWeekComplaints)
                ->description("Hari ini: {$todayComplaints}")
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),
        ];
    }
}
