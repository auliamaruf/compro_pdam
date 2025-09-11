<?php

namespace App\Filament\Resources\FixedCostResource\Pages;

use App\Filament\Resources\FixedCostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFixedCosts extends ListRecords
{
    protected static string $resource = FixedCostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
