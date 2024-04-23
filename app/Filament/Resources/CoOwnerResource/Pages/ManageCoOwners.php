<?php

namespace App\Filament\Resources\CoOwnerResource\Pages;

use App\Filament\Resources\CoOwnerResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCoOwners extends ManageRecords
{
    protected static string $resource = CoOwnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
