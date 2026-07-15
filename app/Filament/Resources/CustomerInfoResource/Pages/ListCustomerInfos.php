<?php

namespace App\Filament\Resources\CustomerInfoResource\Pages;

use App\Filament\Resources\CustomerInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerInfos extends ListRecords
{
    protected static string $resource = CustomerInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
