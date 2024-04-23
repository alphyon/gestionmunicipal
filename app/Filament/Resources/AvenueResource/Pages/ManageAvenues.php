<?php

namespace App\Filament\Resources\AvenueResource\Pages;

use App\Filament\Resources\AvenueResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageAvenues extends ManageRecords
{
    protected static string $resource = AvenueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
