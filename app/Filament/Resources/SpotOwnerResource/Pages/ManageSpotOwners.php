<?php

namespace App\Filament\Resources\SpotOwnerResource\Pages;

use App\Filament\Resources\SpotOwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSpotOwners extends ManageRecords
{
    protected static string $resource = SpotOwnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
