<?php

namespace App\Filament\Resources\WaterSourceResource\Pages;

use App\Filament\Resources\WaterSourceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWaterSources extends ListRecords
{
    protected static string $resource = WaterSourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
