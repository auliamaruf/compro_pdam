<?php

namespace App\Filament\Widgets;

use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ServiceOverview extends BaseWidget
{
    protected ?string $heading = 'Pengelolaan Konten Layanan';
    protected static ?int $sort = 2;
    
    protected function getStats(): array
    {
        $totalServices = Service::count();
        $activeServices = Service::where('is_active', true)->count();
        $inactiveServices = Service::where('is_active', false)->count();
        $featuredServices = Service::where('is_featured', true)->count();
        $servicesWithForms = Service::whereHas('media', function($query) {
            $query->where('collection_name', 'forms');
        })->count();
        $recentlyUpdated = Service::where('updated_at', '>=', now()->subDays(7))->count();
        
        return [
            Stat::make('Total Konten Layanan', $totalServices)
                ->description("Aktif: {$activeServices} | Nonaktif: {$inactiveServices}")
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Layanan Unggulan', $featuredServices)
                ->description('Ditampilkan di halaman utama')
                ->descriptionIcon('heroicon-m-star')
                ->color('warning'),

            Stat::make('Formulir Tersedia', $servicesWithForms)
                ->description('Layanan dengan file formulir')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('info'),

            Stat::make('Update Minggu Ini', $recentlyUpdated)
                ->description('Konten diperbarui 7 hari terakhir')
                ->descriptionIcon('heroicon-m-clock')
                ->color($recentlyUpdated > 0 ? 'success' : 'gray'),
        ];
    }
}
