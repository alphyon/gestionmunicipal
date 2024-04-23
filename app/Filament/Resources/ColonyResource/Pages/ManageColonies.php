<?php

namespace App\Filament\Resources\ColonyResource\Pages;

use App\Filament\Resources\ColonyResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageColonies extends ManageRecords
{
    protected static string $resource = ColonyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
