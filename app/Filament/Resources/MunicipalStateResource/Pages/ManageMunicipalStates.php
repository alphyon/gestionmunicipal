<?php

namespace App\Filament\Resources\MunicipalStateResource\Pages;

use App\Filament\Resources\MunicipalStateResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMunicipalStates extends ManageRecords
{
    protected static string $resource = MunicipalStateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
