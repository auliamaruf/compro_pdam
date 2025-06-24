<?php

namespace App\Filament\Resources\OnlineComplaintResource\Pages;

use App\Filament\Resources\OnlineComplaintResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOnlineComplaint extends EditRecord
{
    protected static string $resource = OnlineComplaintResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
