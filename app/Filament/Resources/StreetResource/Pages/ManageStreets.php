<?php

namespace App\Filament\Resources\StreetResource\Pages;

use App\Filament\Resources\StreetResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageStreets extends ManageRecords
{
    protected static string $resource = StreetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
