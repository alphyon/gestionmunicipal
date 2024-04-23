<?php

namespace App\Filament\Resources\PassageResource\Pages;

use App\Filament\Resources\PassageResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePassages extends ManageRecords
{
    protected static string $resource = PassageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
