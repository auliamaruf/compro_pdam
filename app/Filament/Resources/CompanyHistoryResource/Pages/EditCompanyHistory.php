<?php

namespace App\Filament\Resources\CompanyHistoryResource\Pages;

use App\Filament\Resources\CompanyHistoryResource;
use App\Models\CompanySetting;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompanyHistory extends EditRecord
{
    protected static string $resource = CompanyHistoryResource::class;

    public function mount(int | string $record = null): void
    {
        // Always use the first (and only) CompanySetting record
        $this->record = CompanySetting::firstOrCreate([], [
            'company_name' => 'PDAM Tirta Perwira',
            'company_history' => 'Sejarah perusahaan akan diisi di sini...',
            'history_timeline' => [],
            'is_active' => true,
        ]);

        $this->fillForm();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Kembali ke Dashboard')
                ->icon('heroicon-o-arrow-left')
                ->url(route('filament.admin.pages.dashboard')),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
